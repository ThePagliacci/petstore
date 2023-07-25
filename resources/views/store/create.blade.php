<!doctype html>
<html lang="en">
  <head>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">

    <title>Creat page</title>
  </head>
  <body>
        <!-- navbar -->
        <div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/">
                    <img src="../img/600a25a0ae8e4e0aa56ec1a1eadcdcac (1).png" width="100" height="100" alt="">
                </a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/lost">Lost & Found</a>
                          </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Adoption
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="/adopt">Adobtable Animals</a></li>
                              <li><a class="dropdown-item" href="/tipsforadoption">Adoption Tips</a></li>
                            </ul>
                          </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/ourshop">
                          About us
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/home">Sign up</a>
                      </li>
                    </ul>
                  </div>
               </div>
              </nav>
      </div>
       </div>
        <!-- end of navbar--> 

        <!-- body content-->
        <div class="container">
            <form action="/posts" enctype="multipart/form-data" method="post" >
                @csrf
          <div class="row">
            <div class="container-fluid">
                <h1>Add a New Post</h1>
                <div class="col-8 offset-2">
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">Post Description</label>
    
                        <div class="col-md-6">
                            <textarea name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" cols="10" rows="5" description="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>
    
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="image" class="col-md-4 col-form-label text-md-end" >Post Image</label>
                        <div class="col-md-6">
                        <input type="file" class="form-control-file" id="image" name="image" >

                          @error('image')
                        <strong>{{ $message }}</strong>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-form-label text-md-end" >Your phone number:</label>
                      <div class="col-md-6">
                      <input type="tel" id="phone" name="phone"
                             required>

                             @error('phone')
                             <strong>{{ $message }}</strong>
                             @enderror

                    </div>
                    </div>
                        <button class="btn btn-primary">Add New Post</button>
                </div>
            </div>
            </div>
        </form>
      </div>
        <!-- end of body content--> 

        <!-- footer-->
        <footer class="main-footer">
          <div class="container">
            <div class="row">
              <div class="col-md-4 col-sm-4">
                Follow Us on Our Social Media Account To keep track of our Lost and Found pets Arpund Your Area and Our discounts and offers for you!!
                <hr>
             </div> 
             <div class="col-md-4 col-sm-4">
              By signing up On Our Website You Can get Accsess to Many more privliges
                  <hr>    
             </div>
             <div class="col-md-4 col-sm-4">
              You can read about our reviews from the ministry of Health, and you can leave an honest review about us as well!!! 
                   <hr>    
             </div>
            </div>
          </div>
            </div>
          </footer>          
          <!--end of footer-->     

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>