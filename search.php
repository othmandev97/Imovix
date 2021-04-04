<?php 
include_once('includes/header.php');

?>

<style>
.b_search{
  background-color:#575151;
  padding-bottom:35vh;
}
.result{
    uk-container-large:100vh
}

.uk-panel{
   width: 100%;
}
.uk-overlay-default{
    background : #575151;
}
.uk-search .uk-search-icon{
    color:#fff;
}
.uk-search-input{
    color:#fff;
}

</style>

<body class="b_search" onload="document.getElementById('searchInp').focus()">
    

    <div class="uk-container uk-container-large" >
        

        <div class="uk-position-top-center uk-margin-top">
            <form class="uk-search uk-search-large">
                <span uk-search-icon></span>
                <input class="uk-search-input" id="searchInp" type="search" placeholder="Search...">
            </form>
        </div>
        <a class="uk-position-top-right uk-overlay uk-overlay-default" href="javascript:history.go(-1)">
            <span uk-icon="icon: close; ratio: 2"></span>
        </a>
   

        <div class="result" style="margin:20% 0% 20% 0% !important">
            
            <div class="uk-grid-small uk-child-width-expand@s uk-text-center" uk-grid>
                <div class="results">

                
                </div>
            </div>

        </div>

    </div>

 
    </body>
<?php include_once('includes/footer.php');  ?>   

    <script>

        $(function(){
            var username= '<?php echo $userLogin ?>';
            var timer;

            $("#searchInp").keyup(function(){
                clearTimeout(timer);

                timer = setTimeout(() => {
                    var val = $("#searchInp").val();

                    if(val != ""){
                        $.post("ajax/getSearchResult.php", {term: val, username: username }, function(data){
                            $(".results").html(data);
                        })
                    }else{
                        $(".results").html("");
                    }

                }, 500);

            });
        });

    </script>
