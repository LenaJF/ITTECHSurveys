<div class="ui grid container">
    <div class="sixteen wide column">
        <form class="ui form" action="/main/newSurvey" method="post">
            <h4 class="ui dividing header">About Survey</h4>
            <div class="three fields">
                <div class="field">
                    <label>Identification</label>
                    <input type="text" name="identification" placeholder="Identification" required>
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="field">
                    <label>Survey Title</label>
                    <input tye="text" name="title" placeholder="Survey Title" required>
                </div>
            </div>
            <div class="field">
                <label>Survey Description</label>
                <textarea name="description" placeholder="Survey Description" rows="2"></textarea>
            </div>
            <div class="field">
                <label>Type of Survey</label>
                <select id="typeSurvey" name="typeSurvey">
                    <?php  while($row = $typeSurvey->fetch_assoc()): ?>
                        <option><?= $row['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>


            <div id="listEmployees" class="ui cards">
                <div class="card card-employees">
                    <div class="content">
                        <div class="header">Employees Access</div>
                        <div class="two fields">
                            <div class="field">
                                <label>Filter by Name</label>
                                <input id="filterName" type="text" placeholder="Filter by Name">
                            </div>

                            <div class="field">
                                <label>Filter by Company</label>
                                <input id="filterCompany" type="text" placeholder="Filter by Company">
                            </div>
                        </div>

                        <div class="description">
                            <h4 class="ui dividing header">Employees</h4>
                            <div id="contentEmployess" class="ui very relaxed horizontal list">
                                <div class="item">
                                    <div class="content">
                                        <div class="ui checkbox">
                                            <input type="checkbox">
                                            <label>John Doe</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="ui checkbox">
                                            <input type="checkbox">
                                            <label>John Doe</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <div class="ui checkbox">
                                            <input type="checkbox">
                                            <label>John Doe</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field">
                <label>Attached File</label></br>
                <input type="file" />
            </div>
            <h4 class="ui dividing header">Period of Survey</h4>
            <div class="two fields">
                <div class="field">
                    <label>Start Date</label>
                    <input id="startDate" name="startDate" type="date" placeholder="Start Date"  required>
                </div>
                <div class="field">
                    <label>End Date</label>
                    <input id="endDate"  name="endDate" type="date" placeholder="End Date" required>
                </div>
            </div>
            <h4 class="ui dividing header">Questions <span><button id="addQuestion" class="ui button new-question"><i class="add square icon"></i> New question</button></span></h4>
            <div id="listQuestion" class="container">
                <div class="three fields">
                        <div class="field">
                            <label>Question</label>
                            <input type="text" placeholder="Question" name="name[q1][question]" required>
                        </div>
                        <div class="field">
                            <label>Type of Answer</label>
                            <select class="typeAnswer" name="name[q1][typeAnswer]">
                                <option>Option</option>
                                <option>Text</option>
                                <option>Number</option>
                            </select>
                        </div>
                        <div class="field optionList">
                            <label>Options List</label>
                            <input type="text" placeholder="Options List" name="name[q1][option]">
                        </div>
                        <div class="field">
                            <button class="ui red button remove-question"><i class="remove icon"></i> Remove</button>
                        </div>

                </div>

            </div>

            <a href="../../" class="ui button">Back</a>
            <button class="ui button primary">Submit</button>
        </form>
    </div>
</div>
