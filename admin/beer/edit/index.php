<?
include($_SERVER['DOCUMENT_ROOT'] . '/common/header.php');
$beer_id= $_POST['selectedbeerId'];
$beer = getBeerById($votingDb, $beer_id);
?>
    <form id="createBeer" method="post" enctype="multipart/form-data" action="../saveBeer.php">
        <input name="beer_id" id="beer_id" value="<? echo $beer_id; ?>" class="hidden"/>
        <div class="container">
            <fieldset>
                <legend>Beer Detail</legend>
                <div class="row">
                    <div class="col-sm-2"><label>Name of the Beer</label></div>
                    <div class="col-sm-10"><input type="text" name="beerName" class="inputClass" value="<? echo $beer[1] ?>" required/></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label>Description</label></div>
                    <div class="col-sm-10"><input type="text" name="beerDescription" class="inputClass" value="<? echo $beer[2] ?>" required/></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label>Select image to upload:</label></div>
                    <div class="col-sm-2"><input type="file" name="fileToUpload" id="fileToUpload"/></div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-sm-1"><button type="button" class="btn btn-primary" id="saveForm">Save</button></div>
                <div class="col-sm-11"><button type="button" class="btn btn-primary" id="cancel">Cancel</button></div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $('#cancel').click(function(e){
            window.location.href = '/admin/beer.php';
        });

        $('#saveForm').click(function(e){
            $('#createBeer').submit();
        });
    </script>
<?
include($_SERVER['DOCUMENT_ROOT'] . '/common/footer.php');
?>