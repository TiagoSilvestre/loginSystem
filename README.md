# Sistema de login em PHP usando Orientação a objetos

## Functionalidades

- Registro, Login/Logout, change password
- Possui grupos de usuários
- Logar o usuario através de um cookie do navegador(remember password)
- Proteção contra Csrf
- Validações dos inputs através de classes customizadas
- Criação de hash na senha utilizando um salt, para segurança do banco de dados
- Criação de uma classe para exibir mensagens, flash messages


#### Processo de login: 

É o processo de colocar o id do usuario na sessao php. 
Primeiro passo verifica se o username existe no banco, se sim, pega o 
password digitado e já com a instância do user pega o salt, cria um hash com o valor
que veio do formulário e compara com o password hasheado do user.  Então se o valor do password 
estiver correto ele seta a sessao php com o id do usuario. Depois disso ele verifica o 
campo remember do form para criar o Hash e fazer esse processo.


#### Processo Remember me

Ao logar, se a opção 'remember me' estiver habilitado, é guardado um hash na tabela user_session, 
e tambem é setado um cookie no navegador do usuário com o valor desse hash.

Ao entrar no sistema, no init.php, é verificado se o usuário tem um cookie, se esse cookie for igual
a algum cookie cadastrado na tabela user_session, ele pega o id e loga o usuário automaticamente.


#### Proteção contra Csrf

Através da geração um token em cada formulário(input hidden), 
quando ele envia o formulario ele cria um token na sessão e quando recebe o formulário ele verifica se
os valores que veio do input hidden e o da sessão são iguais.


#### Usuário

Quando instancia um usuario ele verifica se existe a sessao 'user', 
se existir ele faz um get no usuario e seta true em isLoggedIn. Ou seja, 
quando instancia ele tenta pegar o id ou da sessao ou do parametro do construtor.
