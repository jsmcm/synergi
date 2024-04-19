<script setup>

import { Link } from '@inertiajs/vue3';
</script>

<template>

    <!-- ========== HEADER ========== -->
    <header id="header" class="navbar navbar-expand-lg navbar-end navbar-absolute-top navbar-light navbar-show-hide">

        <div class="container">
            <nav class="js-mega-menu navbar-nav-wrap">
                <!-- Default Logo -->
                <Link class="nav" :href="'/'">
                <img class="navbar-brand-logo" src="https://www.synergicode.com/assets/img/logo.svg" alt="Logo">
                </Link>
                <!-- End Default Logo -->




                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-default">
                        <i class="bi-list"></i>
                    </span>
                    <span class="navbar-toggler-toggled">
                        <i class="bi-x"></i>
                    </span>
                </button>
                <!-- End Toggler -->
            
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-absolute-top-scroller">
                        <ul class="navbar-nav">
                            <!-- Landings -->


                            <li class="nav-item">
                              <Link class="nav-link":href="route('login')" role="button">Login</Link>
                            </li>
                            
                        </ul>
                    </div>
                </div>



            </nav>
        </div>
    </header>
    <!-- ========== END HEADER ========== -->


    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <slot /> 
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <footer class="bg-dark">
        <div class="container pb-1 pb-lg-5 mt-7">
            <div class="row content-space-t-2">
              <div class="col-lg-3 mt-7 mb-7">
                    <!-- Logo -->
                    <div class="mb-5 text-white">
                        Synergicode
                    </div>
                    <!-- End Logo -->
                </div>
                <div class="col-lg-9 mt-7 mb-7">
                    <!-- Logo -->
                    <div class="mb-5 text-white">
                        john@softsmart.co.za | +27 71 907 4088
                    </div>
                    <!-- End Logo -->
                </div>

                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </footer>

    <!-- ========== END FOOTER ========== -->

  
  <!-- Go To -->
  <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
     data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": "2rem"
         },
         "show": {
           "bottom": "2rem"
         },
         "hide": {
           "bottom": "-2rem"
         }
       }
     }'>
    <i class="bi-chevron-up"></i>
  </a>
  <!-- ========== END SECONDARY CONTENTS ========== -->

</template>
