<sectio class="p-4 tree">      
    <ul>
          <li><a href="#"><span>{{ auth()->user()->u_fullname }}</span></a> 

            <ul><span class="vtline"></span> 
                <li>
                    <a href=""><span>Mother </span>
                        <small class="text-success">Living</small>
                    </a> 
                  
                </li> 
                <li>
                    <a href=""><span>Mother </span>
                        <small class="text-success">Living</small>
                    </a>  
                </li>

                <li>
                    <a href=""><span>Father</span><small class="text-danger">Dead</small></a> 
                    <ul>
                        <li><a href=""><span>Mother</span><small class="text-danger">Dead</small></a></li>
                        <li><a href=""><span>Father</span><small class="text-success">Living</small></a></li>
                    </ul>
                </li> 
            </ul>
        </li>
    </ul> 
</section> 
@push('style')
<style type="text/css">
    .vtline{
         border-left: 6px solid green;
          height: 20px;
          position: absolute;
          left: 50%;
          margin-left: -3px;
          top: 0;
    }
    *{
        padding: 0;
        margin: 0;
    }

    .tree{   
        text-align: center;
    }

    .tree ul{
        padding-top: 20px;
        position: relative;
        transition: .5s;

    }

    .tree li {
        display: inline-table;
        text-align: :center;
        list-style-type: none;
        position: relative;
        padding: 10px;
        transform: .5s;
    }

    .tree li:before, .tree li:after{
        content: "";
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 1px solid #ccc;
        width: 51%;
        height: 10px;
    }

    .tree li:after{
        right: auto;
        left: 50%;
        border-left: 1px solid #ccc;
    }

    .tree li:only-child:after, .tree li:only-child:before{
        display: none;
    }
    .tree li:only-child{
        padding-top: 0;
    }
  .tree li:first-child:before, .tree li:last-child:after{
       border: 0 none;
    }

 .tree li:last-child:before{
       border-right: 1px solid #ccc;
       border-radius: 0px 5px 0px 0px;
    }

     .tree li:last-child:after{ 
       border-radius: 5px opx 0px 0px;
    }

.tree ul ul:before{
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 1px solid #ccc;
    width: 20px;
}
.tree a{
    border: 1px solid #ccc;
    padding: 10px;
    display: inline-grid;
    border-radius: 5px;
    text-decoration: :none;
    transition:.5s;
}
.tree a img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px !important;
    margin: auto;
}
.tree a span {
    border: 1px solid #ccc;
    color: #666;
    padding: 8px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

.tree li a:hover, .tree li a:hover img, .tree li a:hover span, .tree li a:hover+ul li a {
 
    border: 1px solid green;
    box-shadow: 0px 0px  8px -px #5f5f5f;
}

.tree li a:hover+ul li:after, .tree li a:hover+ul li:before, .tree li a:hover+ul:before,.tree li a:hover+ul ul:before{
    border-color: black;
}

</style>
@endpush