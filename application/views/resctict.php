<h2><?= $error ?></h2>
<h2 class="ui teal image header">
    <img src="/img/logo.jpg" class="image">
    <div class="content">
        Log-in to access the restrict survey
    </div>
</h2>

<form class="ui large form" method="post">
    <div class="ui stacked segment">
        <div class="field">
            <div class="ui left icon input">
                <i class="envelope icon"></i>
                <input type="text" name="email" placeholder="E-mail address">
            </div>
        </div>
        <button class="ui fluid large teal submit button">Access</button>
    </div>
</form>

<div class="ui message">
    New to us? <a href="#">Sign Up</a>
</div>