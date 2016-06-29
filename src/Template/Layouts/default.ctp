<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <?= $this->Html->cssUrl('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'); ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $this->url->to('/H', ['controller' => 'posts', 'action' => 'index']); ?>
                <?= $this->fetch->content; ?>
            </div>
        </div>
    </div>
</body>
</html>