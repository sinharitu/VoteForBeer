<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');

$result = $votingDb->query('select * from beers');
$allBeers = $result->fetch_all();
?>

    <form id="beerAction" method="post" action="beer/edit/index.php">
        <?
        if ($allBeers){
        ?>
        <div class="container data-grid table-responsive">
            <h1>List of beers</h1>
            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Votes</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allBeers as $beer) {
                    $votes = getVotes($votingDb, $beer[0]);
                    $image_src = $beer[3];
                    $id = $beer[0];
                    if (!$image_src) {
                        $image_src = ROOT_IMAGE . '/beer/beer_' . $id . '.png';
                    }
                    ?>
                    <tr>
                        <td><? echo $beer[0] ?></td>
                        <td><img src="<? echo $image_src; ?>" class='img-thumbnail' id="<? echo $id ?>" height="150"
                                 width="150"/></td>
                        <td><? echo $beer[1] ?></td>
                        <td><? echo $beer[2] ?></td>
                        <td><? echo $votes; ?></td>
                        <td><a href="beer/delete" class="deleteBeer" id="delete_<? echo $id ?>">delete</a> | <a href="beer/edit/<? echo $id ?>" class="editBeer" id="edit_<? echo $id ?>">edit</a>
                        </td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
            <? } else {
                echo 'No Beers yet!!!';
            } ?>
            <div class="row">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary" id="createNewBeer">Create new beer</button>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" id="cancel">Back</button>
                </div>
            </div>
        </div>
        <input name="selectedbeerId" id="selectedbeerId" class="hidden" value=""/>
    </form>
    <script type="text/javascript">
        $('#createNewBeer').click(function (e) {
            window.location.href = '/admin/beer/edit';
        });

        $('.editBeer').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var beer_id= id.substring(id.indexOf("_")+1, id.length);
            $('#selectedbeerId').val(beer_id);
            $('#beerAction').submit()
        });

        $('.deleteBeer').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var beer_id= id.substring(id.indexOf("_")+1, id.length);
            $('#selectedbeerId').val(beer_id);
            alert('Issue processing your request. Please try again later');
        });

        $('#cancel').click(function (e) {
            window.location.href = '/admin';
        });
    </script>
<?
include($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php');
$votingDb->close();
?>