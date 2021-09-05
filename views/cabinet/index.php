<?php
include_once ROOT.'/views/layouts/header.php';
?>



<div class="container">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo User::getAvatar($userId);?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['username'];?></h5>
                    <p class="card-text">Это более широкая карта с вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                    <p class="card-text"><small class="text-muted"><a href="/cabinet/edit" style="color: #00aced">Редактировать</a> данные</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
