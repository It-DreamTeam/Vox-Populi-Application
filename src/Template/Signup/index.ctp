<?php
echo $this->Form->create(null, [
    'url' => ['controller' => 'Signup', 'action' => 'index']
]);


?>
<?= $this->Form->input('firstname', ['label'       => FALSE,
                                    'div'         => FALSE,
                                    'class'       => 'form-control',
                                    'placeholder' => 'Prénom'
]); ?>

<?= $this->Form->input('lastname', ['label'       => FALSE,
                                    'div'         => FALSE,
                                    'class'       => 'form-control',
                                    'placeholder' => 'Nom'
]); ?>

<?= $this->Form->input('email', ['label'       => FALSE,
                                    'div'         => FALSE,
                                    'class'       => 'form-control',
                                    'placeholder' => 'Email'
]); ?>
<?= $this->Form->input('password', ['label'       => FALSE,
                                    'div'         => FALSE,
                                    'class'       => 'form-control',
                                    'placeholder' => __('Mot de passe')
]); ?>
<br/>
<?= $this->Form->button('<i class="fa fa-lock"></i>' . __('S\'inscrire'), ['class' => 'btn btn-theme btn-block']) ?>
