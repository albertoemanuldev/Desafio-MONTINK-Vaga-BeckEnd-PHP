# 🧾 Mini ERP - Sistema de Gestão de Produtos, Pedidos e Estoque

Este é um **Mini ERP (Enterprise Resource Planning)** desenvolvido em **PHP puro** utilizando o padrão de arquitetura **MVC**, com banco de dados **MySQL**, estilização com **Twinland CSS** e **Bootstrap 5**.

## 🧱 Estrutura do Projeto

```sh
ERP_MONTINK/
├── assets/css/ # Estilos com Twinland + Bootstrap
├── config/ # Configurações gerais (conexão DB)
├── controllers/ # Lógica de controle (MVC)
├── models/ # Regras de negócio e acesso ao banco
├── public/ # Página pública e webhook
├── sql/ # Script SQL de criação das tabelas
├── views/ # Interfaces divididas por módulo
│ ├── carrinho/
│ ├── cupons/
│ ├── layouts/ # header.php / footer.php
│ ├── pedidos/
│ └── produtos/ # form.php, index.php, lista.php
├── .htaccess # Reescrita de URLs (mod_rewrite)
└── README.md # Este arquivo
````
---
## Imagens do Desafio

![Captura de tela 2025-05-29 204922](https://github.com/user-attachments/assets/0ed19088-b0e9-498c-a23a-55ed0557721d)
![Captura de tela 2025-05-29 204914](https://github.com/user-attachments/assets/9b0956b7-59d2-4402-815c-bdf962e7167c)
![Captura de tela 2025-05-29 204900](https://github.com/user-attachments/assets/8379b420-8ee8-4df4-8343-26e96800514c)
![Captura de tela 2025-05-29 204802](https://github.com/user-attachments/assets/09648d5c-327f-4434-bbec-6f9ef431d265)
![Captura de tela 2025-05-29 204932](https://github.com/user-attachments/assets/b87ffe07-9d0b-4a9b-b4ef-4450183041d0)

## ⚙️ Tecnologias Utilizadas

- **PHP 8+** (sem frameworks)
- **MySQL 8+**
- **Bootstrap 5**
- **[Twinland CSS](https://twinland.org)** – Utilitário CSS leve
- **Padrão MVC** (Model-View-Controller)
- **JavaScript básico** (onde necessário)

---

## 📦 Funcionalidades

- ✅ Cadastro, edição e exclusão de produtos
- ✅ Controle de estoque
- ✅ Gestão de cupons de desconto
- ✅ Registro de pedidos e carrinho de compras
- ✅ Webhook de integração externa
- ✅ Layout modular com reutilização de `header` e `footer`

---

## 🚀 Como Executar Localmente

### 1. Clone o repositório
bash
git clone https://github.com/seu-usuario/erp-montink.git

### 2. Ajustando Banco de Dados
Configure o banco de dados
Crie um banco MySQL chamado mini_erp
```sh
Importe o arquivo /sql/mini_erp.sql
CREATE DATABASE mini_erp;

Atualize as credenciais do banco
Edite o arquivo config/database.php com seu usuário e senha do MySQL:
USE mini_erp;
-- importe o conteúdo de mini_erp.sql
$host = 'localhost';
$user = 'root';
$pass = 'sua_senha';
$db   = 'mini_erp';
````
🔒 Segurança
Uso de prepared statements para evitar SQL Injection

Separação clara entre camadas de lógica, visual e dados

Desenvolvido com ☕ e código limpo.
