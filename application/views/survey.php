<div class="ui grid container">
    <div class="secretDiv">
        <h1 id="user"><?= $empl ?></h1>
        <h1 id="survey" ><?= $surveyIdent ?></h1>
    </div>
    <div class="sixteen wide column">
        <form class="ui form">
            <div class="ui grid container">
                <div class="four wide column">
                    <img class="ui medium image" src="/img/default.png">
                </div>
                <?php while($row = $survey->fetch_assoc()): ?>
                <div class="six wide column">
                    <h4 class="ui dividing header">Survey Title</h4>
                    <p><?= $row['title'] ?></p>
                    <h4 class="ui dividing header">Survey Description</h4>
                    <p><?= $row['description'] ?></p>
                    <h4 class="ui dividing header">Type of Survey</h4>
                    <p><?= $row['type'] ?></p>
                </div>
                <div class="six wide column">
                    <h4 class="ui dividing header">Employees</h4>
                    <ul class="ui list">
                        <li>John Doe</li>
                        <li>John Doe</li>
                        <li>John Doe</li>
                    </ul>
                    <h4 class="ui dividing header">Period of Survey</h4>
                    <p><strong><?= $row['start'] ?></strong> to <strong><?= $row['end'] ?></strong></p>
                </div>
                <?php endwhile;  ?>
                <div class="sixteen wide column">
                    <h4 class="ui dividing header">Questions</h4>
                    <?php while($row = $questions->fetch_assoc()){?>
                    <div class="field">
                        <label><?= $row['question']?></label>
                        <?php if($row['type']=="Option"){
                            $variant_answer = explode("|", $row['answer']); ?>
                            <select>
                                <?php foreach ($variant_answer as $item){?>
                                    <option><?= $item ?></option>
                                <?php }?>
                            </select>
                        <?php }else{?>
                            <input type="text" placeholder="Your answer" required>
                        <?php } ?>
                    </div>
                    <?php }?>

                    <a href="/" class="ui button">Cancel</a>
                    <button id="addHistory" class="ui button primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>