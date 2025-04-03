# Desafio técnico - Desenvolvedor Backend CasalarShop

Seja bem-vindo!

Esse repositório descreve o desafio técnico do processo seletivo de Desenvolvedor Backend da Casalar Shop. Abaixo você encontrará os requisitos do desafio.
Clone esse repositório, crie uma branch para a sua implementação e submeta o seu Pull Request para avaliação (Pull Request da sua branch para a branch `main`). Não é permitido enviar commits diretamente para a branch `main`.

## Importação e listagem de séries.

- Construir um projeto em PHP com 2 rotas públicas:
  1. Uma rota deverá "importar" séries da API Open Movie Database (https://omdbapi.com) e cadastrá-las em banco de dados;
  2. A outra rota deverá retornar uma listagem de todas as séries importadas

- A rota de "importar" séries deve receber o título da série como parâmetro (obrigatório). O sistema, então, deverá consultar a API do OMDB pesquisando a série pelo título. A série deve ser salva em uma tabela em banco de dados. A escolha das colunas dessa tabela (informações da série) fica a critério do dev. Caso a série não seja encontrada, a rota deve ter comportamento condizente, também a critério do dev.

- A rota de listagem deve buscar as séries cadastradas e possibilitar um filtro por nota (avaliação imdb). Exemplo:
  - Caso eu passe o parâmetro 8 no filtro de nota, a rota deve retornar apenas as séries com avaliação 8.0 ou superior;
  - Atenção, pois é um parâmetro não obrigatório.

## Observações:
  - Frameworks, bibliotecas, padrões de projeto/código e arquitetura ficam a critério do dev, o único requisito tecnológico é que o projeto seja feito em PHP;
  - Tudo o que não estiver na descrição, fica a critério do dev;
  - A API OMDB necessita de uma API Key para autenticação, que pode ser criada através do link da omdb, de forma gratuita;
