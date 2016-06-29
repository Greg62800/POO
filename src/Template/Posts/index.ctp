<?php $this->fetch->title = "Blog"; ?>
<h2>Blog</h2>

<p class="lead">
    <?= count($posts); ?> Articles sur le blog
</p>

<?php foreach($posts as $post): ?>
    <h2>
        <a href="<?= $post->slug; ?>">
            <?= $post->name; ?>
        </a>
    </h2>
<?php endforeach; ?>