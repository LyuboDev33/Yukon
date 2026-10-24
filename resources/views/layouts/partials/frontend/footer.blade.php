
<!-- Footer Start -->
<footer class="footer bg-cover jarallax" data-jarallax data-speed=".2">
   <img src="/assets/images/footer-bg.jpg" alt="Фон на футъра" class="jarallax-img">
   <div class="parallax-overly"></div>
   <div class="container">

      <div class="row footer-widgets">
         <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
            <div class="footer-widget about-footer">
               <div class="f-logo">
                  <a href="{{ url('/') }}">
                     <x-logo  width="250"/>
                  </a>
               </div>

               <p>
                  Юкон ООД произвежда качествени кашони и опаковки от велпапе,
                  съобразени с нуждите на вашия бизнес. С опит от 1996 г.
                  предлагаме надеждни и практични решения за опаковане и транспорт.
               </p>

               <div class="social-share">
                  <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                  <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                  <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
               </div>
            </div>
         </div>

         <div class="col-lg-2 col-sm-4 offset-sm-1 offset-lg-0">
            <div class="footer-widget">
               <h3 class="widget-title">Полезни връзки</h3>
               <ul>
                  <li><a href="{{ url('/') }}">Начало</a></li>
                  <li><a href="{{ url('/#za-nas') }}">За нас</a></li>
                  <li><a href="{{ url('/#produkti') }}">Нашите продукти</a></li>
                  <li><a href="{{ url('/#materiali') }}">Материали</a></li>
                  <li><a href="{{ url('/#kontakti') }}">Контакти</a></li>
               </ul>
            </div>
         </div>

         <div class="col-lg-3 ps-lg-5 col-sm-6">
            <div class="footer-widget">
               <h3 class="widget-title">Нашите продукти</h3>
               <ul>
                  <li><a href="{{ url('/#produkti') }}">Транспортни кашони</a></li>
                  <li><a href="{{ url('/#produkti') }}">Щанцови опаковки</a></li>
                  <li><a href="{{ url('/#produkti') }}">Ламинирани опаковки</a></li>
                  <li><a href="{{ url('/#produkti') }}">Рекламни дисплеи</a></li>
                  <li><a href="{{ url('/#produkti') }}">Разделители и решетки</a></li>
                  <li><a href="{{ url('/#produkti') }}">Специализирани опаковки</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>

   <div class="footer-bottom">
      <div class="container">
         <div class="d-flex flex-wrap justify-content-between align-items-center">
            <p class="text-info copy-right mb-0 order-2 order-md-1">
               Авторски права &copy; {{ date('Y') }}
               <a href="{{ url('/') }}">Юкон ООД</a>. Всички права запазени.
            </p>

            <nav class="footer-nav order-1 order-md-2">
               <ul>
                  <li><a href="{{ route('privacy') }}">Политика за поверителност</a></li>
                  <li><a href="{{ route('conditions') }}">Общи условия</a></li>
               </ul>
            </nav>
         </div>
      </div>
   </div>
</footer>
<!-- Footer End -->
