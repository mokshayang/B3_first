<h3 class="ct">訂單清單</h3>
<div> 快速刪除 : 
    依日期 <input type="radio" name="type" value="date" checked >
           <input type="text" id="date">
    依電影 <input type="radio" name="type" value="movie">
           <select id="movie">
            <?php
            $ords = $Ord->all(" group by movie  ");
            foreach($ords as $ord){
                echo "<option value='{$ord['movie']}'>{$ord['movie']}</option>";
            }
            ?>
           </select>
           <button onclick="qDel()">刪除</button>
</div>
<style>
.head,.items{
    display: grid;
    grid-template-columns: repeat(4,2fr) 1fr 2fr 2fr;
    align-items: center;
    text-align: center;
}
.head{
    grid-gap: 3px;
}
.head div{
    background-color: #ccc;

}
.allh{
    height: 350px;
    overflow: auto;
}
.items{
    height: 90px;
    border: 1px solid #999;
    border-radius: 10px;
    margin-top: 5px;
    background: linear-gradient(white,#ccc,white);

}
</style>
<br>
<div class="head">
    <div>訂單編號</div>
    <div>電影名稱</div>
    <div>日期</div>
    <div>場次時間</div>
    <div>訂購數量</div>
    <div>訂購位置</div>
    <div>操作</div>
</div>

<div class="allh">
    <?php 
     $ords = $Ord->all(" order by num desc");
     foreach($ords as $ord){
    ?>
    <div class="items">
        <div><?=$ord['num']?></div>
        <div><?=$ord['movie']?></div>
        <div><?=$ord['date']?></div>
        <div><?=$ord['session']?></div>
        <div><?=$ord['qt']?></div>
        <div>
            <?php
            $seats = unserialize($ord['seats']);
            foreach($seats as $seat){
                echo floor(($seat/5)+1)."排".($seat%5+1)."號";
                echo "<br>";
            }
            ?>
        </div>
        <div>
            <button onclick="del('ord',<?=$ord['id']?>)">刪除</button>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    function qDel(){
    let type = $("input[name='type']:checked").val();
    let val;
    switch(type){
        case 'date':
            val = $('#date').val();
            break;
        case 'movie':
            val = $('#movie').val()
            break;
    }
    
    let chk = confirm(`是否確定刪除${val}的所有訂單嗎 ?`);
    if(chk){
        $.post("./api/qDel.php",{type,val},(res)=>{
            // console.log(res);
            location.reload();
        })
    }
}
</script>