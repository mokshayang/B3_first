<div class="ct">線上訂票</div>
<div class="ord">
    <table>
        <tr>
            <td>電影 :</td>
            <td>
                <select id="#moves"></select>
            </td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td>
                <select id="#days"></select>
            </td>
        </tr>
        <tr>
            <td>場次 :</td>
            <td>
                <select id="#sieesion"></select>
            </td>
        </tr>
    </table>
    <div class="ct">
        <button onclick="$('.ord,.booking').toggle()">確定</button>
        <button onclick="reset()">重置</button>
    </div>
</div>
<div class="booking" style="display:none">
    <div>你選擇的電影<span id="move"></span></div>
    <div>你選擇的日期<span id="day"></span>&nbsp;&nbsp;<span id="sess"></span></div>
    <div>已勾選 <span id="num"></span> 張票，最多四張</div>
</div>
