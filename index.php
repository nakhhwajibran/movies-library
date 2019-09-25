<?php
include 'db_connection.php';
$sql = "Select * from movie_list WHERE status = 1 ORDER BY title ASC LIMIT 10";
$result = mysqli_query($conn,$sql);
?>
<head>
<link rel="stylesheet" type="text/css" href="movie.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>
<body>
<div class="search-form">
    <input type="text" placeholder="Search Movies" id="search_movie" class="search__input" onkeyup="search_movie()" />
    <button class="btn search-btn" id="addMovies">Add</button>
    <select class="btn search-btn" id="sort_by" onchange="search_movie()" >
        <option value="">Select Sort By</option>
        <option value="title">Title</option>
        <option value="year">Year</option>
        <option value="rating">Rating</option>
    </select>
    <select class="btn search-btn" id="order_by" onchange="search_movie()" >
        <option value="">Select Order By</option>
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    </select>
</div>
</div>
<div class="grid" id="row">
    <?php foreach($result as $k => $data) { ?>
    <div class="card movie-card">
        <div class="card-header">
            <div class="ratio-container a16by9">
                <img src="images/<?= $data['img_src'] ?>">
            </div>
        </div>
        <div class="card-body">
                <div class="movie-title">
                    <span><?= trim($data['title']) ?></span>
                    <i class="movie-year">(<?= trim($data['year']) ?>)</i>
                </div>
                <?php
                $star = '';
                for($i = 0; $i < $data['rating'] ; $i++){
                    $star .= '&#9733' ;
                }
                ?>
            <div class="movie-rating"><?= $star ?></div>
        </div>
        <div class="card-footer">
            <button onclick='deleteImage(<?= $data['id'] ?>)' class="btn delete">Delete</button>
        </div>
    </div>
    <?php } ?>
</div>
<div id="addPopUpMovies" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <div class="close">&times;</div>
        </div>
        <div class="modal-body">
            <form action="" id="add_form" name='add_form' class="add-form" method="post">
                <div class="form-group">
                    <input type="text" id='movie_title' name='movie_title' class="movie_title" placeholder="Movie Name" required>
                    <input type="number" id="year" name='year' placeholder="Year" required>
                </div>
                <div class="form-group">
                    <input type="number" class="movie_rating" id="rating" name='rating' placeholder="Rating" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label>Image:</label>
                    <input type="file" name="add_img_src" id="add_img_src" required>
                </div>
                <div>
                    <input type="submit" name='submit' class='btn search-btn' value="ADD"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<script>
    $('#addMovies').click(function(){
        $('#addPopUpMovies').show();
    });

    $('.close').click(function(){
        $('#addPopUpMovies').hide();
    });
    function search_movie() {
        var search_by = $('#search_movie').val();
        var sort_by = $('#sort_by').val();
        var order_by = $('#order_by').val();
        $.ajax({
            type:'POST',
            data : {
                value : search_by , sort_by : sort_by , order_by : order_by
            },
            url : 'search.php',
            success : function(data){
                if(data !=''){
                    var response = JSON.parse(data);
                    var str = '';
                    $('#row').html('');
                    $.each(response, function(key,v) {
                        var star = '';
                        for (var counter = 0;counter < v.rating;counter++)
                        {
                            star += '&#9733';
                        }
                        var str = '<div class="card movie-card"><div class="card-header"><div class="ratio-container a16by9">';
                        str += '<img src="images/' + v.img_src + '" >';
                        str += '</div></div><div class="card-body"><div class="movie-title"><span>';
                        str += v.title;
                        str += '</span><i class="movie-year">(';
                        str += v.year;
                        str += ')</i></div><div class="movie-rating">'+ star +'</div></div><div class="card-footer">'
                        str += '<button onclick="deleteImage('+ v.id +')" class="btn delete" >Delete</button>';
                        str+= '</div></div>';
                        $('#row').append(str);
                    });
                } else {
                    var str = '';
                    $('#row').html('');
                        var str = '<div class="card movie-card"><div class="card-header"><div class="ratio-container a16by9">';
                        str += '<img>';
                        str += '</div></div><div class="card-body"><div class="movie-title"><span>';
                        str += 'No Movies';
                        str += '</div><div class="card-footer">'
                        str+= '</div></div>';
                        $('#row').append(str);
                }
            }
        });

    }

    $('#add_form').submit(function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('file', $('#add_img_src')[0].files[0]);
        formData.append('title', $('#movie_title').val());
        formData.append('year', $('#year').val());
        formData.append('rating', $('#rating').val());
        $.ajax({
            type:'POST',
            url : 'add.php',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            success : function(data){
                var res = JSON.parse(data);
                if(res.message1 == 'Successfully'){
                    var star = '';
                    for (var counter = 0;counter < res.rating;counter++)
                    {
                        star += '&#9733';
                    }
                    var str = '<div class="card movie-card"><div class="card-header"><div class="ratio-container a16by9">';
                    str += '<img src="images/' + res.fileName + '" >';
                    str += '</div></div><div class="card-body"><div class="movie-title"><span>';
                    str += res.title;
                    str += '</span><i class="movie-year">(';
                    str += res.year;
                    str += ')</i></div><div class="movie-rating">'+ star +'</div></div><div class="card-footer">'
                    str += '<button onclick="deleteImage('+ res.id +')" class="btn delete" >Delete</button>';
                    str+= '</div></div>';
                    $('#row').prepend(str);
                    $('#addPopUpMovies').hide();
                    $('#movie_title').val('');
                    $('#year').val('');
                    $('#rating').val('');
                    $('#img_src_name').val('');
                    alert(res.message);
                } else{
                    alert(res.message);
                    return false;
                }
            },
        });
    });

    function deleteImage(id) {
        if(confirm('Are sure you want to delete this movie')){
            $.ajax({
                type: 'POST',
                data : { id : id },
                url : 'delete.php',
                success : function(res){
                    location.reload();
                }
            });
        }
    }
</script>