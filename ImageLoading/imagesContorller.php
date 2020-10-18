<?php

namespace Localhost\ImageLoading;

use Localhost\Service\DB;
use Localhost\SessionClass\SessionManager;


class imagesContorller
{
    protected static string $dir = '../uploaded';
    protected static string $queryAll = 'SELECT `user_id`,`name`,`views`, `id` FROM `pictures`';
    protected static string $sqlAll = 'SELECT `user_id`, `user_login` FROM `users`';

    protected static string $select_where = 'SELECT `user_login` FROM `users` WHERE `user_id` = :id';

    protected static string $queryMy = 'SELECT `user_id`,`name`, `id` FROM `pictures` WHERE `user_id` = :id';

    protected static string $queryOne = 'SELECT `name`,`views` FROM `pictures` WHERE `id` = :id';
    protected static string $queryOneUpdate = 'UPDATE `pictures` SET `views` = `views`+1 WHERE `id` = :id';

    public static function ShowOne($file)
    {
        $pdo = new DB();
        $options = [':id' => $file];
        $pdo->update(self::$queryOneUpdate, $options);
        $allViewsData = $pdo->execute(self::$queryOne, $options); ?>

        <img src="../uploaded<?= DIRECTORY_SEPARATOR . $allViewsData['name'] ?>" class="pimg" title="<?= $file ?>"/>
            <p align="center" >Просмотров: <?= $allViewsData['views'] ?></p>
        <?php }

    public static function ShowMy()
    {
        $pdo = new DB();
        $options = [':id' => SessionManager::create()->user('user_id')];
        $PicData = $pdo->executeAll(self::$queryMy, $options);

        if (!empty(self::$dir++)) {
            foreach ($PicData as $rowPicData) { ?>
                <table align="center" id="uploaded_image" border="2">
                    <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                        <td>
                            <?php
                            if (SessionManager::create()->user('user_id') === $rowPicData['user_id']) {
                                echo SessionManager::create()->user('user_login'); } ?>
                            <a href="deleteImage.php?id=<?=  $rowPicData['name'] ?>">Удалить<a>
                        </td>
                    </thead>
                    <tbody align="center" bgcolor="black">
                        <tr>
                            <td>
                                <a href="details.php?id=<?= $rowPicData['id'] ?>">
                                    <div id="uploaded_image" class="blok_img">
                                        <img src="../uploaded/<?= $rowPicData['name']?>" width="500px" class="pimg" title="<?= $rowPicData['name'] ?>"/>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table><br>
                <?php
            }
        }
    }

    public static function ShowUser()
    {
        $pdo = new DB();
        $options = [':id' => $_GET['id'] ];
        $PicData = $pdo->executeAll(self::$queryMy, $options);

        if (!empty(self::$dir)) {
            foreach ($PicData as $rowPicData) { ?>
                <table align="center" id="uploaded_image" border="2" width="650px" height="650px">
                    <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                    <td>
                        <?php
                        if ($rowPicData['user_id'] === $rowPicData['user_login']) {
                            echo SessionManager::create()->user('user_login'); } ?>
                    </td>
                    </thead>
                    <tbody align="center" bgcolor="black">
                    <tr>
                        <td>
                            <a href="details.php?id=<?= $rowPicData['name'] ?>">
                                <div id="uploaded_image" class="blok_img">
                                    <img src="<?= $rowPicData['name']  ?>" height="550px" class="pimg" title="<?= $rowPicData['name'] ?>"/>
                                </div>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table><br>
                <?php
            }
        }
    }

    public static function ShowMyNotAuth()
    {
        $pdo = new DB();
        $options = [':id' => SessionManager::create()->user('user_id')];
        $PicData = $pdo->executeAll(self::$queryMy, $options);

        if (!empty(self::$dir)) {
            foreach ($PicData as $rowPicData) { ?>
                <table align="center" id="uploaded_image" border="2" width="650px" height="650px">
                    <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                    <td>
                        <?php
                        if (SessionManager::create()->user('user_id') === $rowPicData['user_id']) {
                            echo SessionManager::create()->user('user_login'); } ?>
                    </td>
                    </thead>
                    <tbody align="center" bgcolor="black">
                    <tr>
                        <td>
                            <a href="details.php?id=<?= $rowPicData['name'] ?>">
                                <div id="uploaded_image" class="blok_img">
                                    <img src="<?= $rowPicData['name']  ?>" height="550px" class="pimg" title="<?= $rowPicData['name'] ?>"/>
                                </div>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table><br>
                <?php
            }
        }
    }

    public static function ShowAll()
    {
        $pdo = new DB();

        $allViewsData = $pdo->select(self::$queryAll);
        $allUsersData = $pdo->select(self::$sqlAll);

        if (!empty(self::$dir)) {
            foreach ($allViewsData as $PicData) {
                foreach ($allUsersData as $rowUsersData) { ?>
                    <table align="center" id="uploaded_image" border="2" width="650px" height="650px">
                    <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                        <?php if ($PicData['user_id'] === $rowUsersData['user_id']) { ?>
                            <?php if ( $rowUsersData['user_login'] != SessionManager::create()->user('user_login') ){ ?>
                        <td><a href="lk_form.php?id=<?= $rowUsersData['user_id']; } ?>"> <?= $rowUsersData['user_login'] ?></a></td>
                        <?php } } ?>
                    </thead>
                        <tbody align="center" bgcolor="black">
                            <tr>
                                <td>
                                    <a href="details.php?id=<?= $PicData['name'] ?>">
                                        <div class="blok_img">
                                            <img src="../uploaded/<?= $PicData['name'] ?>" height="550px" class="img" title="<?= $PicData['name']; ?>"/>
                                        </div>
                                    </a>
                                    <?php foreach ($allViewsData as $rowViewData) {
                                        if ($rowViewData['name'] == $PicData['name']) { ?>
                                            <p id="views" style="color: white">Просмотров: <?= $rowViewData['views'] ?></p>
                                        <?php } } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table><br>
            <?php }
        }
    }

    public static function AdmShowUser()
    {
        $pdo = new DB();
        $id = $_GET['id'];
        $options = [':id' => $_GET['id'] ];
        $PicData = $pdo->executeAll(self::$queryMy, $options);
        $UsersData = $pdo->execute(self::$select_where, $options); ?>
        <table align="center">
            <td>
                <a href="deleteProfile.php?id=<?= $id ?>">Удалить профиль</a>
            </td>
        </table>
        <?php if (!empty(self::$dir)) {
        foreach ($PicData as $rowPicData) { ?>
            <table align="center" id="uploaded_image" border="2" width="650px" height="650px">
                <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                <td>
                    <?php
                    echo $UsersData['user_login']; ?>
                    <a href="deleteImage.php?id=<?=  $rowPicData['name'] ?>"><font color="red">Удалить</font><a>
                </td>
                </thead>
                <tbody align="center" bgcolor="black">
                <tr>
                    <td>
                        <a href="details.php?id=<?= $rowPicData['name'] ?>">
                            <div id="uploaded_image" class="blok_img">
                                <img src="<?= $rowPicData['name']  ?>" height="550px" class="pimg" title="<?= $rowPicData['name'] ?>"/>
                            </div>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table><br>
            <?php
        }
    }
    }

    public static function AdmShowAll()
    {
        $pdo = new DB();

        $allViewsData = $pdo->select(self::$queryAll);
        $allUsersData = $pdo->select(self::$sqlAll);

        if (!empty(self::$dir)) {
            foreach ($allViewsData as $PicData) {
                foreach ($allUsersData as $rowUsersData) { ?>
                    <table align="center" id="uploaded_image" border="2" >
                    <thead bgcolor="#2F4F4F" style="color: #FFFFFF ">
                    <?php if ($PicData['user_id'] === $rowUsersData['user_id']) { ?>
                        <?php if ( $PicData['user_id'] == SessionManager::create()->user('user_id') ){ ?>
                        <td>
                            <a href="lk_form.php">
                                <?=SessionManager::create()->user('user_login')?>
                            </a>
                            <a href="deleteImage.php?id=<?=$PicData['name']?>">
                                <font color="blue">Удалить</font>
                            </a>
                        </td>
                            <?php } if ( $PicData['user_id'] !== SessionManager::create()->user('user_id') ){ ?>
                        <td>
                            <a href="lk_form.php?id=<?= $rowUsersData['user_id'] ?>">
                                <font color="#f0f8ff"><?= $rowUsersData['user_login'], " " ?><font>
                            </a>
                            <a href="deleteImage.php?id=<?=  $PicData['name'] ?>">
                                <font color="red">Удалить</font>
                            </a>
                        </td>
                    <?php } } } ?>
                </thead>
                <tbody align="center" bgcolor="black">
                <tr>
                    <td>
                        <a href="ImageLoading/details.php?id=<?= $PicData['id'] ?>">
                            <div class="blok_img">
                                <img width="500px" src="../uploaded/<?= $PicData['name'] ?>" width="650px" class="img"
                                     title="<?= $PicData['name']; ?>"/>
                            </div>
                        </a>
                        <?php foreach ($allViewsData as $rowViewData) {
                            if ($rowViewData['name'] == $PicData['name']) { ?>
                                <p id="views" style="color: white">Просмотров: <?= $rowViewData['views'] ?></p>
                            <?php } } ?>
                    </td>
                </tr>
                </tbody>
                </table><br>
            <?php }
        }
    }

    public static function delete($file)
    {
        $pdo = new DB();
        $query = 'DELETE FROM `pictures` WHERE `name` = (?)';
        $options = $file;
        $pdo->insert($query, [$options]);
        unlink($file);
    }
}