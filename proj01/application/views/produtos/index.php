<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-sca le=1">
    <meta name="description" content="Curso CI">
    <meta name="author" content="José Malcher Jr.">

    <title>Site Institucional</title>

    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

</head>
<body>

    <div class="container">

        <h1>Produtos</h1>
        <table class="table">
            <?php foreach ($produtos as $produto) : ?>
                <tr>
                    <td><?= $produto["nome"]; ?></td>
                    <td><?= $produto["preco"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>


<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js')?>"></script>
</body>
</html>