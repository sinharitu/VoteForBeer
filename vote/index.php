<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/headerLink.php');
$alreadyVoted = getNumberOfVotesForCurrentWeek($votingDb, $_SESSION['userid']);
$allowedNumberOfVotes = getMaxVotesPerUser($votingDb);
$result = $votingDb->query('select * from beers')->fetch_all();
$allBeers = $result;
?>

<h1 class="votingHeader">Vote for your favourite beer!!!!</h1>
<h4>select the beer and click on vote</h4>
<div id="beerCarousel" class="owl-carousel">
    <? foreach ($allBeers as $beer) {
        $id = $beer[0];
        $name = $beer[1];
        $image_src = $beer[3];
        if (!$image_src) {
            $image_src = ROOT_IMAGE.'beer/beer_' . $id . '.png';
        }
        ?>

        <div class="item">
            <img src="<? echo $image_src; ?>" class ='img-thumbnail selectBeer img-circle' id="<? echo $id ?>" alt="Owl Image"/>
            <p class="voteDisplay" id="beer_<? echo $id ?>"></p>
            <p><? echo $name ?></p>
        </div>

    <? } ?>
</div>
<div>
    <button type="button" class="btn btn-primary" id="saveForm" style="color: #1b1b1b">Vote</button>
</div>
<script>
    $(document).ready(function () {
        $('#saveForm').click(function(e){
            var alreadyVoted = " <?php echo $alreadyVoted ?> ";
            var allowedVotes = " <?php echo $allowedNumberOfVotes ?> ";
            if(alreadyVoted==allowedVotes){
                alert("The allowed number of votes per week is "+allowedVotes+". You have already voted "+alreadyVoted+" times.Come back again next week");
            }

            if(confirm("The allowed number of votes per week is "+allowedVotes+". You have already voted "+alreadyVoted+" times.Do you want to continue?"))
            {
                flag = false;
                $(".selectBeer").each(function () {
                    if ($(this).hasClass('selected')) {
                        flag = true;
                        id = $(this).attr('id');
                    }
                });

                if (!flag) {
                    alert('Please select a beer to vote for! ');
                    return false;
                }
                var url = '/ajax/vote.php';
                $.ajax({
                    url: url,
                    data: {'id': id},
                    type: 'post',
                    datatype: 'json',
                    success: function (output) {
                        var response = JSON.parse(output);
                        if (response.flag == true) {
                            alert(response.message);
                            $('#beer_' + id).innerHTML = response.votes;
                        }
                    }
                });
            }
        });

        $("#beerCarousel").owlCarousel({
            autoPlay: 1800,
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],
            autoplayHoverPause:true,
            afterUpdate: function () {
                updateSize();
            },
            afterInit:function(){
                updateSize();
            }
        });

        $('img').click(function(){
            $('.selected').removeClass('selected'); // removes the previous selected class
            $(this).addClass('selected'); // adds the class to the clicked image
        });

        function updateSize(){
            var minHeight=parseInt($('.owl-item').eq(0).css('height'));
            $('.owl-item').each(function () {
                var thisHeight = parseInt($(this).css('height'));
                minHeight=(minHeight<=thisHeight?minHeight:thisHeight);
            });
            $('.owl-wrapper-outer').css('height',minHeight+'px');

            /*show the bottom part of the cropped images*/
            $('.owl-carousel .owl-item img').each(function(){
                var thisHeight = parseInt($(this).css('height'));
                if(thisHeight>minHeight){
                    $(this).css('margin-top',-1*(thisHeight-minHeight)+'px');
                }
            });

        }
    });
</script>
<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php');
?>
