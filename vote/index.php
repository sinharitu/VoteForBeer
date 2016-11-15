<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');

if ($_SESSION['loggedin']) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/headerLink.php');
    $alreadyVoted = getNumberOfVotesForCurrentWeek($votingDb, $_SESSION['userid']);
    $allowedNumberOfVotes = getMaxVotesPerUser($votingDb);
    $result = $votingDb->query('select * from beers')->fetch_all();
    $allBeers = $result;
    ?>

    <h1 class="votingHeader">Vote for your favourite beer!!!!</h1>
    <h4>select the beer and click on vote</h4>
    <div id="beerCarousel" class="owl-carousel">
        <?php foreach ($allBeers as $beer) {
            $id = $beer[0];
            $votes = getVotes($votingDb, $id);
            $name = $beer[1];
            $image_src = $beer[3];
            if (!$image_src) {
                $image_src = ROOT_IMAGE . 'beer/beer_' . $id . '.png';
            }
            ?>

            <div class="item">
                <img src="<?php echo $image_src; ?>" class='img-thumbnail selectBeer img-circle' id="<?php echo $id ?>"
                     alt="Owl Image"/>
                <p class="voteDisplay">Total votes: <span id="beer_<?php echo $id ?>"><?php echo $votes; ?></span></p>
                <p><?php echo $name ?></p>
            </div>

        <?php } ?>
    </div>
    <div>
        <button type="button" class="btn btn-primary" id="saveForm" style="color: #1b1b1b">Vote</button>
    </div>
    <script>
        $(document).ready(function () {
            $('#saveForm').click(function (e) {
                var alreadyVoted = " <?php echo $alreadyVoted ?> ";
                var allowedVotes = " <?php echo $allowedNumberOfVotes ?> ";
                if (alreadyVoted == allowedVotes) {
                    alert("The allowed number of votes per week is " + allowedVotes + ". You have already voted " + alreadyVoted + " times.Come back again next week");
                }
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
                            $('#beer_' + id).text(response.votes);
                        }
                    }
                });
            });

            $("#beerCarousel").owlCarousel({
                autoPlay: 1800,
                items: 3,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                autoplayHoverPause: true,
                afterUpdate: function () {
                    updateSize();
                },
                afterInit: function () {
                    updateSize();
                }
            });

            $('img').click(function () {
                $('.selected').removeClass('selected'); // removes the previous selected class
                $(this).addClass('selected'); // adds the class to the clicked image
            });

            function updateSize() {
                var minHeight = parseInt($('.owl-item').eq(0).css('height'));
                $('.owl-item').each(function () {
                    var thisHeight = parseInt($(this).css('height'));
                    minHeight = (minHeight <= thisHeight ? minHeight : thisHeight);
                });
                $('.owl-wrapper-outer').css('height', minHeight + 'px');

                /*show the bottom part of the cropped images*/
                $('.owl-carousel .owl-item img').each(function () {
                    var thisHeight = parseInt($(this).css('height'));
                    if (thisHeight > minHeight) {
                        $(this).css('margin-top', -1 * (thisHeight - minHeight) + 'px');
                    }
                });

            }
        });
    </script>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php');
} else {
    ?>
    <h3><a href="<?php echo getSite(); ?>login/index.php" class="TrHover homepage">Login to access the page</a></h3>
    <?php
}
?>