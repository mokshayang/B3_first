<div class="ct">新增院線片</div>
<?php
$row = $Movie->find($_GET['id']);
$ondate = explode("-",$row['ondate']);
// dd($ondate);
?>
<form action="./api/total.php?api=save_movie" method="post" enctype="multipart/form-data">
    <div style="width:90%;margin:auto">
        <div style="display:flex;">
            <div>影片資料</div>
            <div style="width:90%">
                <table>
                    <tr>
                        <td>片名:</td>
                        <td><input type="text" name="name" value="<?=$row['name']?>"></td>
                    </tr>
                    <tr>
                        <td>分級:</td>
                        <td>
                            <select name="level" id="">
                                <option value="1" <?=($row['level']==1)?'selected':'';?>>普遍級</option>
                                <option value="2" <?=($row['level']==2)?'selected':'';?>>輔導級</option>
                                <option value="3" <?=($row['level']==3)?'selected':'';?>>保護級</option>
                                <option value="4" <?=($row['level']==4)?'selected':'';?>>限制級</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>片長:</td>
                        <td><input type="number" name="length" value="<?=$row['length']?>"></td>
                    </tr>
                    <tr>
                        <td>上映日期:</td>
                        <td>
                            <select name="year" id="">
                                <option value="2023" <?=($ondate[0]==2023)?'selected':'';?>>2023</option>
                                <option value="2024" <?=($ondate[0]==2024)?'selected':'';?>>2024</option>
                            </select>
                            <select name="month" id="">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $sel = ($ondate[1]==$i)?'selected':'';
                                    echo "<option value='$i' $sel >$i</option>";
                                }
                                ?>
                            </select>
                            <select name="day" id="">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    $sel = ($ondate[2]==$i)?'selected':'';
                                    echo "<option value='$i' $sel>$i</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>發行商</td>
                        <td><input type="text" name="publish" value="<?=$row['publish']?>"></td>
                    </tr>
                    <tr>
                        <td>導演</td>
                        <td><input type="text" name="director" value="<?=$row['director']?>"></td>
                    </tr>
                    <tr>
                        <td>預告影片</td>
                        <td><input type="file" name="trailer" id=""></td>
                    </tr>
                    <tr>
                        <td>電影海報</td>
                        <td><input type="file" name="poster" id=""></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="display:flex;">
            <div>劇情簡介</div>
            <div style="width:90%;margin:20px auto;" >
                <textarea name="intro" style="width:95%;height:3rem">value="<?=$row['intro']?>"</textarea>
            </div>
        </div>
        <div class="ct">
            <input type="hidden" name="id" value="<?=$_GET['id']?>">
            <input type="submit" value="編輯">
            <input type="reset" value="重置">
        </div>
    </div>
</form>