<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="cn">
<head>
    <meta charset="UTF-8">
    <title>天气查询</title>
    <!-- <link rel="stylesheet" href="/book11-15/Public/Dist/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="/book11-15/Public/Dist/css/bootstrap-theme.min.css"> -->
    <style>

    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>天气查询</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" class="form">
                    <div class="input-group">
                        <span class="input-group-addon">请输入城市名称</span>
                        <input type="text" class="form-control" name="city" placeholder="<?php echo ($_POST['city']); ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default">提交</button>
                        </span>
                    </div>
                </form>
            </div>

        </div>

        <div style="height:20px;"></div>

        <div class="row">

            <div class="col-md-12">
                <?php
 if ($data->error != 0) { ?>
                <p class="alert alert-danger">城市错误！</p>
                <?php
 } ?>

<!--                 <p>
                    <?php echo ($data->date); ?>
                </p>
                <p>
                    <?php echo ($data->results[0]->currentCity); ?>
                </p>
                <p>
                    pm2.5 <?php echo ($data->results[0]->pm25); ?>
                </p> -->
                <div class="row">
                <?php
 foreach($data->results[0]->weather_data as $v): ?>

                    <div class="col-md-3">
                    <p><?php echo ($v->date); ?></p>
                    <p>
                        <?php echo ($v->weather); ?>
                        <img width="15" height="15" src="<?php echo ($v->dayPictureUrl); ?>" alt="">
                        <img width="15" height="15" src="<?php echo ($v->nightPictureUrl); ?>" alt="">
                    </p>
     <!--                <p><?php echo ($v->wind); ?></p> -->
                    <p><?php echo ($v->temperature); ?></p>
                    </div>
                <?php
 endforeach; ?>
                <div>


            </div>
        </div>
    </div>

</body>
</html>