<?php
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Produto.php';

class PedidoController {
    public function finalizar() {
        $carrinho = $_SESSION['carrinho'] ?? [];
        if (empty($carrinho)) {
            $_SESSION['erro'] = 'Carrinho vazio!';
            header('Location: ?controller=carrinho');
            exit;
        }
        $cep = $_POST['cep'] ?? '';
        $endereco = $_POST['endereco'] ?? '';
        $cupom = $_POST['cupom'] ?? '';
        $subtotal = 0;
        foreach ($carrinho as $item) {
            $subtotal += $item['preco'] * $item['quantidade'];
        }
        // Cálculo do frete
        if ($subtotal > 200) {
            $frete = 0;
        } elseif ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15;
        } elseif ($subtotal > 0) {
            $frete = 20;
        } else {
            $frete = 0;
        }
        $desconto = Pedido::calcularDesconto($cupom, $subtotal);
        $total = $subtotal + $frete - $desconto;
        $pedido_id = Pedido::criar($subtotal, $frete, $total, $cep, $endereco, $carrinho, $cupom, $desconto);
        // Atualiza estoque
        foreach ($carrinho as $item) {
            Produto::baixarEstoque($item['produto_id'], $item['variacao'], $item['quantidade']);
        }
        // Envio de e-mail
        $to = 'seuemail@seudominio.com'; // Altere para o e-mail desejado
        $subject = 'Novo Pedido #' . $pedido_id;
        $body = "Novo pedido realizado!\n\n";
        $body .= "Endereço: $endereco\nCEP: $cep\n\n";
        $body .= "Itens:\n";
        foreach ($carrinho as $item) {
            $body .= "- {$item['nome']} ({$item['variacao']}) x {$item['quantidade']} = R$ ".number_format($item['preco'] * $item['quantidade'],2,',','.')."\n";
        }
        $body .= "\nSubtotal: R$ ".number_format($subtotal,2,',','.')."\n";
        $body .= "Frete: R$ ".number_format($frete,2,',','.')."\n";
        $body .= "Desconto: R$ ".number_format($desconto,2,',','.')."\n";
        $body .= "Total: R$ ".number_format($total,2,',','.')."\n";
        @mail($to, $subject, $body);
        unset($_SESSION['carrinho']);
        $_SESSION['msg'] = 'Pedido realizado com sucesso!';
        header('Location: ?controller=pedido&action=historico');
        exit;
    }

    public function historico() {
        $pedidos = Pedido::listar();
        include __DIR__ . '/../views/pedidos/index.php';
    }

    public function confirmar() {
        $id = $_POST['id'] ?? null;
        $forma = $_POST['forma_pagamento'] ?? null;
        if ($id && $forma) {
            Pedido::confirmar($id, $forma);
            $_SESSION['msg'] = 'Pedido confirmado com sucesso!';
        }
        header('Location: ?controller=pedido&action=historico');
        exit;
    }

    public function cancelar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Pedido::cancelar($id);
            $_SESSION['msg'] = 'Pedido cancelado!';
        }
        header('Location: ?controller=pedido&action=historico');
        exit;
    }
} 