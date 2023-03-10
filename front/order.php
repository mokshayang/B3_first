<div class="ct">線上訂票</div>
<div class="ord">
    <table style="width:50%;margin:auto;text-align:center">
        <tr>
            <td>電影 :</td>
            <td>
                <select id="movs"></select>
            </td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td>
                <select id="days"></select>
            </td>
        </tr>
        <tr>
            <td>場次 :</td>
            <td>
                <select id="session"></select>
            </td>
        </tr>
    </table>
    <div class="ct">
        <button onclick="$('.ord,.booking').toggle();booking();">確定</button>
        <button onclick="reset()">重置</button>
    </div>
</div>
<div class="booking" style="display:none">

</div>
<script>
    getMov();

    function booking(){
        let info = {
            'movie':$('#movs option:selected').text(),
            'date':$('#days').val(),
            'session':$('#session').val(),
        }
        $.get("api/get_booking.php",info,(res)=>{
            $('.booking').html(res);
            $('#mov').text(info.movie);
            $('#day').text(info.date);
            $('#sess').text(info.session);
        })
    }

    function getMov(){
        let par = location.href.split("?")[1].split("&");
        let mov = $('#movs');
        
        $.get("api/get_movie.php",(res)=>{
            mov.html(res);
            if(par[1]) $(`option[value=${par[1].split("=")[1]}]`).attr('selected',true)
            getDay(mov.val());
            mov.on('change',()=>{
                getDay(mov.val());
            })
        })
    }
    function getDay(id){
        let day = $('#days');
        $.get("api/get_day.php",{id},(res)=>{
            day.html(res);
            getSess(id,day.val());
            day.on('change',()=>{
                getSess(id,day.val());
            })
        })
    }
    function getSess(id,date){
        $.get("api/get_session.php",{id,date},(res)=>{
            $('#session').html(res)
        })
    }

</script>