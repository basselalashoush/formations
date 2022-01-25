<?php $title = "profile"; ?>

<div class="hero-unit">
    <h1> Welcome <?= strtoupper($student->nom) ?> <?= $student->prenom ?></h1>
</div>
<div class="profile-body">
    <p><?= $student->nom ?></p>

</div>