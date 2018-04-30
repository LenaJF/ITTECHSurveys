<div class="ui grid">
    <div class="banner wide column sixteen">
        <div id="forBanner">
            <div class="bannerImg" id="img2">
                <h2>ITTECHSurveys<br>
                    Шаг 2: Соберите ответы
                </h2>
            </div>
            <div class="bannerImg" id="img1">
                <h2>ITTECHSurveys<br>
                    Шаг 3: Распечатайте результаты
                </h2>
            </div>
            <div class="bannerImg" id="img3">
                <h2>ITTECHSurveys<br>
                    Шаг 1: Создайте новый опрос
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="ui grid container">
    <div class="sixteen wide column">
        <h1 class="ui header">Open surveys <a class="ui button primary new-survey" href="/main/registerSurvey"><i class="add square icon"></i> New survey</a></h1>
    </div>
</div>

<div class="ui grid container">
    <?php while($row = $data->fetch_assoc()):?>
    <!-- Survey -->
    <div class="four wide column">
        <div class="ui card">
            <div class="image">
                <img src="../img/default.png">
            </div>
            <div class="content">
                <a class="header" href="/main/survey/<?= $row['ident'] ?>" ><?= $row['title'] ?></a>
                <div class="meta">
                    <span class="date"><strong><?= $row['start'] ?></strong> to <strong><?= $row['end'] ?></strong></span>
                </div>
            </div>
            <div class="extra content">
                <i class="check icon"></i>
                <?= $row['completed'] ?> Completed surveys
            </div>
        </div>
    </div>
    <!-- /Survey -->
    <?php endwhile; ?>

</div>