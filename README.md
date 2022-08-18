# configOL Parser

Parse un fichier `configOL.xml` et retourne un objet `ConfigOL`

## Installation

```shell
composer require unofficialmc2/configol-parser
```

## Usage

```php
$parser = new ConfigOlParser('configOL.xml');
$config = $parser->get('SCHEMA');
echo $config->baseNom;
```

## Exception

### FileNotFound

L'exception `FileNotFound` est levée lorsque le fichier configOL.xml n'a pas été trouvé.

### BadConfigOl

L'exception `BadConfigOl` est levée lorsque le contenu du fichier configOl.xml n'est pas du XML valide ou qu'une information requise est manquante dans un schema. 

### SchemaNotFound

L'exception `SchemaNotFound` est levée lorsque le schema demandé n'est pas déclaré dans le configOl.xml.
