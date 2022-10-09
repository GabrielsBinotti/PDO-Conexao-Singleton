# PDO-Conexao-Singleton

Esse exemplo permite apenas uma unica instancia da conexão. Pode ser modificada conforme necessario caso queira utilizar constantes, variaveis de ambientes ao invés
de deixar as configurações diretamente no arquivo.

## Forma de Usar

Deve-se importar o arquivo de conexão, isso pode ser feito utilizando o autoload psr-4 e namespaces ou de forma manual mesmo usando o require.
Após feito a importação a chamada do método de conexão e sua utilização em suas consultas ficariam como no exemplo abaixo:


### SELECT ALL
```
$pdo = Connection::getConnection();
$stmt = $pdo->prepare("SELECT * FROM TABELA");
$stmt->execute();
$return = $stmt->fetchAll();
```

### SELECT COM WHERE
```
$pdo = Connection::getConnection();
$stmt = $pdo->prepare("SELECT * FROM TABELA WHERE id=:id");
$stmt->bindValue(':id',1);
$stmt->execute();
$return = $stmt->fetch();
```

### INSERT
```
$pdo = Connection::getConnection();
$stmt = $pdo->prepare("INSERT INTO TABELA(nome, telefone) VALUES(:nome, :telefone) ");
$stmt->bindValue(":nome", "Valor");
$stmt->bindValue(":telefone", "Valor");
$return = $stmt->execute();
```

### UPDATE
```
$pdo = Connection::getConnection();
$stmt = $pdo->prepare("UPDATE TABELA SET nome=:nome WHERE id=:id");
$stmt->bindValue(":id", "Valor");
$stmt->bindValue(":nome", "Valor");
$return = $stmt->execute();
```

### DELETE
```
$pdo = Connection::getConnection();
$stmt = $pdo->prepare("DELETE FROM TABELA WHERE id=:id");
$stmt->bindValue(":id", "Valor");
$return = $stmt->execute();
```

## bindValue X bindParam
De forma simples o <strong>bindParam</strong> recebe uma variavel, não aceitando valores diretos e nem retorno de funções.
```
$var = 1;
$stmt->bindParam(':campo', $var);
```

O <strong>bindValue</strong> aceita valores diretos, variaveis e retorno de funções
```
$stmt->bindValue(':campo', getValor());
```

## Inserindo valores nulos
```
$stmt->bindValue(":campo", null, PDO::PARAM_NULL);
```

## Terceiro parâmetro do bindValue / bindParam
O terceiro parâmetro seria o tipo de dados, ele pode ser omitido mas caso queira pode ser passado sem nenhum problema. Para valores nulos ele é obrigatório.
```
$stmt->bindValue(':campo', getValor(), PDO::PARAM_INT);
```

## Prepare X Query
A dirença está que na <strong>$stmt->query()</strong> as consultas são executadas juntamente com os valores nela passados, sem quaisquer tratamentos interno.<br>
O <strong>$stmt->prepare()</strong> é chamada de "Prepare Instatement". A declaração preparada é um recurso usado para executar as mesmas (ou similares) instruções SQL repetidamente com alta eficiência. Os valores para a consulta são passados através de parâmetros, que são tratados evitando SQL injection.
