# 1 Como executar o projeto


<p>As instruções dessa documentação assumem que o leitor possui conhecimento da tecnologia Git e possui a mesma instalada e configurada em sua máquina.</p>

<p>Primeiramente, realize o download do código-fonte do projeto ou clone o repositório.</p>


## 1.1 Requisitos

- PHP ^8.1.3
- Composer ^2.2.6
- MySQL ^8.0.28


## 1.2 Configuração do PHP (arquivo "php.ini")

<p>Extensões que precisam estar habilitadas:</p>

- curl
- fileinfo
- gd
- mbstring
- openssl
- pdo_mysql

<p>Configurações adicionais necessárias:</p>

<p>post_max_size = 8M</p>
<p>upload_max_filesize = 6M</p>


## 1.3 Configuração das variáveis de ambiente (arquivo ".env")

<p>Crie uma cópia do arquivo ".env.example" e renomeie a cópia para ".env".</p>

<p>Realize as configurações de conexão com o banco de dados e do e-mail de testes, conforme as instruções presentes no arquivo ".env" criado.</p>


## 1.4 Comandos a serem executados pelo terminal, na raiz do projeto

### 1.4.1 Instalação das dependências do projeto

<p>composer install</p>

### 1.4.2 Criação das tabelas no banco de dados

<p>php artisan migrate</p>

### 1.4.3 Geração da chave de encriptação da aplicação

<p>php artisan key:generate</p>

### 1.4.4 Disponibilização do acesso aos arquivos públicos da aplicação

<p>php artisan storage:link</p>

### 1.4.5 Execução do projeto (ficará acessível em: "http://localhost:8000")

<p>php artisan serve</p>

### 1.4.6 Processamento do envio de e-mails em segundo plano (executar comando em outra aba do terminal)

<p>php artisan queue:work</p>




# 2 Como contribuir com o projeto


<p>Primeiramente, solicite ao proprietário Danilo a concessão do acesso como contribuidor do projeto.</p>


## 2.1 Requisitos

- Node.js ^17.5.0


## 2.2 Instalação das dependências para desenvolvimento

<p>Utilize o seguinte comando pelo terminal, na raiz do projeto:</p>

<p>npm install</p>


## 2.3 Gerenciamento dos assets do projeto

<p>O projeto utiliza o pacote Laravel Mix para compilar e versionar os diversos arquivos .css referentes aos componentes e telas do repositório em um único arquivo "app.css", o qual será processado pelo navegador.</p>

<p>Utilize o seguinte comando pelo terminal, na raiz do projeto, para ficar observando mudanças nos arquivos .css e realizar o processo de compilação e versionamento automaticamente:</p>

<p>npm run watch</p>

<p>Quando criar um novo arquivo .css ou houver falha durante o processo, será necessário cancelar o processo do comando e executá-lo novamente.</p>
