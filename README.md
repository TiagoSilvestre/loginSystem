# Sistema de login em PHP

## Inclui, registro de usuarios, login, logout, salt para segurança das senhas no banco de dados,
funcionalidade remember me, change password

### Hash Session COOKIE = ao logar é guardado um hash na sessao, se o usuario tiver esse hash, 
ao entrar no sistema é feita uma requisição na tabela users_session, se existir o hash lá, 
ele pega o id e seleciona o usuario e instancia. USADO PARA O REMEMBER
### Remember = Cookie com o nome 'hash'
Se o remember do login for true, ele vai dar um get em users_session com o id do usuario, 
se existir ele seta no cookie aquele hash, senao ele cria um novo hash e cadastra na tabela, 
pois o usuario já entrou com seu username e senha e ja estao corretos esses dados.

### Usuario = Quando instancia um usuario ele verifica se existe a sessao 'user', 
se existir ele faz um get no usuario e seta true em isLoggedIn. Ou seja, 
quando instancia ele tenta pegar o id ou da sessao ou do parametro do construtor.

- Senha = 

- Salt = 

- Token = 



### Processo de login: é o processo de colocar o id do usuario na sessao php. 
Primeiro passo verifica se o username existe no banco, se sim, pega o 
password digitado e já com a instância do user pega o salt, cria um hash, 
e compara com o password hasheado do user.  Então se o valor do password 
estiver correto ele seta a sessao php com o id do usuario. 
Depois disso ele verifica o campo remember do form para criar o Hash e fazer esse processo