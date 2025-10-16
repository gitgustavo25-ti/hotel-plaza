# Hotel Plaza - Sistema de Gerenciamento de Hospedagens

Este projeto foi desenvolvido como parte do Trabalho de Conclusão de Curso (TCC) em Gestão da Tecnologia da Informação pelo Instituto Federal do Sudeste de Minas Gerais (Polo Muriaé-MG), sob a orientação do Professor Paulo Vinícius.

## Criador

- **Gustavo Menezes** - [GitHub](https://github.com/gitgustavo25-ti/)

---

## Sobre o Projeto

O **Hotel Plaza** é uma plataforma web desenvolvida para simplificar a conexão entre hóspedes e anfitriões. O sistema oferece uma interface amigável para anfitriões que desejam disponibilizar suas propriedades e gerenciar reservas, e para hóspedes que buscam encontrar a hospedagem ideal para suas necessidades.

## Funcionalidades Principais

- 👤 **Cadastro de Usuários:** Perfis separados para Anfitriões e Hóspedes.
- 🏨 **Gerenciamento de Hospedagens:** Anfitriões podem cadastrar, editar e remover suas propriedades.
- 🔍 **Busca e Filtro:** Hóspedes podem pesquisar e filtrar por hospedagens disponíveis.
- 📅 **Sistema de Reservas:** Fluxo completo de solicitação, aprovação/recusa e gerenciamento de reservas.
- 📱 **Notificação via WhatsApp:** Após a aprovação da reserva, o sistema facilita o contato via WhatsApp para finalização.

## Tecnologias Utilizadas

- **Backend:** PHP 8
- **Banco de Dados:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Frameworks/Bibliotecas:** Bootstrap, jQuery, PHPMailer

---

## Guia de Instalação Local

Siga os passos abaixo para rodar o projeto em seu computador.

### Pré-requisitos

Antes de começar, garanta que você tenha os seguintes softwares instalados:
- **XAMPP:** (ou outro ambiente que forneça Apache, PHP e MySQL). [Download aqui](https://www.apachefriends.org/download.html).
- **Composer:** Gerenciador de dependências para PHP. [Download aqui](https://getcomposer.org/).
- **Git:** Sistema de controle de versão. [Download aqui](https://git-scm.com/).

### Passos da Instalação

1.  **Inicie os Serviços:**
    - Abra o Painel de Controle do XAMPP e inicie os módulos **Apache** e **MySQL**.

2.  **Clone o Repositório:**
    - Navegue até a pasta `htdocs` do seu XAMPP (geralmente `C:\xampp\htdocs`) e clone o projeto:
      ```bash
      cd C:\xampp\htdocs
      git clone https://github.com/gitgustavo25-ti/ht.git
      ```
    - Isso criará uma pasta chamada `ht` com todos os arquivos do projeto.

3.  **Instale as Dependências:**
    - Pelo terminal, entre na pasta do projeto e rode o Composer para instalar as bibliotecas (como o PHPMailer):
      ```bash
      cd C:\xampp\htdocs\ht
      composer install
      ```

4.  **Crie e Importe o Banco de Dados:**
    - Abra seu navegador e acesse `http://localhost/phpmyadmin/`.
    - Crie um novo banco de dados chamado `hotel_db`.
    - Selecione o banco `hotel_db`, vá na aba "Importar" e envie o arquivo `hotel_db.sql` que está na pasta `bd` do projeto.

5.  **Acesse o Sistema:**
    - Tudo pronto! Abra seu navegador e acesse:
      ```
      http://localhost/ht/
      ```

---

## Como Usar o Sistema

O sistema possui dois tipos principais de usuários:

#### Anfitrião
-   Pode se cadastrar através da página de cadastro de anfitrião.
-   Após o login, tem acesso a um painel para **cadastrar**, **editar** e **visualizar** suas hospedagens.
-   Recebe e gerencia as **solicitações de reserva** feitas por hóspedes, podendo aprová-las ou recusá-las.

#### Hóspede
-   Pode se cadastrar através da página de cadastro de hóspede.
-   Pode navegar pelas hospedagens disponíveis.
-   Após o login, pode realizar uma **reserva** em uma hospedagem, preenchendo as datas e a quantidade de pessoas.
-   Gerencia suas próprias reservas e recebe a notificação de aprovação.

## Contato

Se tiver dúvidas ou sugestões, entre em contato: **gitgustavo25@gmail.com**