<?php
    $myTemplates = [
        'inputContainer' => '{{content}}',
        'input'          => '<input type="{{type}}" name="{{name}}" {{attrs}}>',

    ];
    $this->Form->templates($myTemplates);
?>

<?= $this->Form->create('user', [
    'role'  => 'form-role',
    'class' => 'form-login'
]);
?>
    <h2 class="form-login-heading"><?= __('Connection') ?></h2>
    <div class="login-wrap">
        <?php echo $this->Flash->render('auth'); ?>
        <?php echo $this->Flash->render(); ?>

        <?= $this->Form->input('email', ['label'       => FALSE,
                                            'div'         => FALSE,
                                            'class'       => 'form-control',
                                            'placeholder' => 'Email'
        ]); ?>
        <br/>
        <?= $this->Form->input('password', ['label'       => FALSE,
                                            'div'         => FALSE,
                                            'class'       => 'form-control',
                                            'placeholder' => __('Mot de passe')
        ]); ?>
        <br/>
        <?= $this->Form->button('<i class="fa fa-lock"></i>' . __(' SE CONNECTER'), ['class' => 'btn btn-theme btn-block']) ?>
        <br/>
        <a class="btn btn-block google btn-danger" href="<?= $this->Url->build(['action' => 'googlelogin']); ?>"> <i
                class="fa fa-google-plus modal-icons"></i> Se connecter avec Google+ </a>
    </div>
<?= $this->Form->end(); ?>
