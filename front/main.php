<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <style>
        #poster {
            width: 420px;
            height: 400px;
            position: relative;
        }

        .lis {
            width: 210px;
            height: 280px;
            margin: auto;
            overflow: hidden;
            text-align: center;
            position: relative;
        }

        .pos {
            position: absolute;
            display:none;

        }

        .pos img {
            width: 100%;
            height: 260px;
        }
    </style>
    <div class="rb tab" style="width:95%;">
        <div id="poster">
            <div class="lis">

                <?php
                $pos = $Tp->all(['sh' => 1], " order by rank");
                foreach ($pos as $po) {
                ?>
                    <div class="pos" data-ani="<?= $po['ani'] ?>">
                        <img src="upload/<?= $po['img'] ?>" >
                        <div><?= $po['name'] ?></div>
                    </div>
                <?php } ?>
            </div>



            <style>
                .con {
                    width: 420px;
                    height: 110px;
                    position: absolute;
                    bottom: 0;
                    display: grid;
                    grid-template-columns: 1fr 8fr 1fr;
                    justify-items: center;
                    align-items: center;
                }

                .bt,
                .lef,
                .rig {
                    cursor: pointer;
                }

                .lef,
                .rig {
                    border-bottom: 20px solid transparent;
                    border-top: 20px solid transparent;
                }

                .rig {
                    border-left: 20px solid blue;
                }

                .lef {
                    border-right: 20px solid blue;
                }

                .bts {
                    width: 320px;
                    overflow: hidden;
                    display: grid;
                    grid-auto-flow: column;
                    grid-gap: 8px;
                    text-align: center;
                    height: 100px;
                }

                .bt {
                    width: 72px;
                    position: relative;
                }

                .bt img {
                    width: 100%;
                    height: 80px;
                }
            </style>
            <div class="con">
                <div class="lef"></div>
                <div class="bts">
                    <?php
                    $pos = $Tp->all(['sh' => 1], " order by rank");
                    foreach ($pos as $po) {
                    ?>
                        <div class="bt">
                            <img src="upload/<?= $po['img'] ?>" alt="">
                            <div><?= $po['name'] ?></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="rig"></div>
            </div>
        </div>
    </div>
</div>

<script>
    let num = $('.bt').length,
        p = 0;
    $('.lef,.rig').on('click', function() {

        if ($(this).hasClass('lef')) {
            p = (p > 0) ? p - 1 : p
        } else {
            p = (p < num - 4) ? p + 1 : p
        }
        console.log(p);
        $('.bt').animate({
            right: 80 * p
        })
    })

    //big 
    let po = $('.pos');
    po.eq(0).show();
    now = 0 ;

    let counter = setInterval(()=>{
        ani()
    },2500)
    $('.bt').on('click',function(){
        let pic = $(this).index();
        ani(pic);
    })
    function ani(next){
        now = $('.pos:visible').index();
        if(typeof(next)=="undefined"){
            next = (now+1 < po.length)?now+1:0;
        }
        type = po.eq(next).data('ani');
        switch(type){
            case 1:
                po.eq(now).fadeOut(1000,()=>{
                    po.eq(next).fadeIn(1000)
                })
                break;
            case 2:
                po.eq(now).slideUp(1000,()=>{
                    po.eq(next).slideDown(1000)
                })
                break;
            case 3:
                po.eq(now).hide(1000,()=>{
                    po.eq(next).show(1000)
                })
                break;
        }
    }
    $('.bts').hover(
        function(){
            clearInterval(counter)
        },
        function(){
            counter = setInterval(()=>{
                ani()
            },2500)
        },
    )
</script>
<style>
    .grid {
        display: grid;
        width: 100%;
        grid-template-columns: 1fr 1fr;
        border: 1px solid #fff;
        border-radius: 5px;
        justify-items: center;
        align-items: center;

    }

    .item {
        display: grid;
        grid-auto-rows: 20px 30px 20px 20px;
        justify-self: start;
    }

    .all {
        display: grid;
        height: 340px;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 160px 160px;
        grid-gap: 10px;

    }

    .bb {
        grid-column: span 2;
    }

    .gg img {
        border-radius: 3px;
        box-shadow: 0 0 2px #ccc;
        cursor: pointer;
    }
</style>


<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="all">
            <?php
            $today = date("Y-m-d");
            $startDay = date("Y-m-d", strtotime("-2 days"));
            $tt = $Movie->count(['sh' => 1], " && ondate between '$startDay' and '$today' order by rank ");

            $div = 4;
            $pages = ceil($tt / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $rows = $Movie->all(['sh' => 1], " && ondate between '$startDay' and '$today' order by rank limit $start,$div ");
            foreach ($rows as $row) {
            ?>
                <div class="grid">
                    <div class="gg">
                        <img src="./upload/<?= $row['poster'] ?>" width="80px" onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">
                    </div>
                    <div class="item">
                        <div><?= $row['name'] ?></div>
                        <div> <img src="./icon/03C0<?= $row['level'] ?>.png"> </div>
                        <div>上映日期 : </div>
                        <div><?= $row['ondate'] ?></div>
                    </div>
                    <div class="bb">
                        <button onclick="location.href='?do=intro&id=<?= $row['id'] ?>'">劇情簡介</button>
                        <button onclick="location.href='?do=order&id=<?= $row['id'] ?>'">線上訂票</button>
                    </div>
                </div>

            <?php } ?>
        </div>

        <style>
            .ct a {
                text-decoration: none;
            }
        </style>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $size = ($i == $now) ? "20px" : '16px';
                echo "<a href='?p=$i' style='font-size:$size'>";
                echo "&nbsp; $i &nbsp;";
                echo "</a>";
            }
            ?>
        </div>

    </div>
</div>