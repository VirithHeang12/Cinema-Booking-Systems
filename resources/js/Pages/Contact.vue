<template>
    <v-container class="mt-[30px]">

      <div>
        <!-- Banner Section -->
        <div class="row">
          <div class="col-12">
            <img
              src="/public/image/contact.jpg"
              alt="" class="img-fluid w-100 !h-[570px] rounded-[25px]" />
          </div>
        </div>


        <v-breadcrumbs :items="items" class="px-0 mt-[15px] mb-0 text-[17px] text-gray-300">
          <template v-slot:divider>
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M10.25 16.25C10.1493 16.2466 10.0503 16.2227 9.95921 16.1797C9.86807 16.1367 9.78668 16.0756 9.72001 16C9.57956 15.8594 9.50067 15.6688 9.50067 15.47C9.50067 15.2713 9.57956 15.0806 9.72001 14.94L12.72 11.94L9.72001 8.94002C9.66069 8.79601 9.64767 8.63711 9.68277 8.48536C9.71786 8.33361 9.79933 8.19656 9.91586 8.09322C10.0324 7.98988 10.1782 7.92538 10.3331 7.90868C10.4879 7.89198 10.6441 7.92391 10.78 8.00002L14.28 11.5C14.4205 11.6407 14.4994 11.8313 14.4994 12.03C14.4994 12.2288 14.4205 12.4194 14.28 12.56L10.78 16C10.7133 16.0756 10.6319 16.1367 10.5408 16.1797C10.4497 16.2227 10.3507 16.2466 10.25 16.25Z"
                  fill="#757575"></path>
              </g>
            </svg>
          </template>
        </v-breadcrumbs>


        <h2 class="text-3xl font-semibold text-gray-300 mb-10">{{ __('contactPage.contact_info') }}</h2>

        <!-- Contact Form Section -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-[30px]">

          <!-- Hotline Card -->
          <div class="overflow-hidden rounded-lg !border !border-gray-600 bg-secondary/50 ">
            <div class="border border-white bg-white/10 px-4 py-5 lg:p-6">
              <h2 class="text-2xl text-gray-300 font-extrabold ms-2">{{ __('contactPage.contact_info')  }}</h2>
            </div>

            <div class="space-y-4 p-4 lg:px-6 lg:py-9 mt-0">
              <div class="flex items-center gap-2.5 rounded-[12px] border border-white/5 bg-white/10 p-4 lg:gap-4 lg:p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-telephone-fill"
                  viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                </svg>
                <span class="font-bold text-gray-300">081 300 400</span>
              </div>

              <div>
                <a href="#" rel="noopener noreferrer" target="_blank" class="block"
                  style="text-decoration: none; color: white;">
                  <div class="flex items-center gap-2.5 rounded-[12px] border-white/5 bg-white/10 p-4 lg:gap-4 lg:p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                      class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                      <path
                        d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671" />
                      <path
                        d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791" />
                    </svg>

                    <span class="font-bold text-gray-300">info@cinema.com.kh</span>
                  </div>
                </a>
              </div>

             <div>
              <a target="_blank" class="block"
              style="text-decoration: none; color: white;"
              href="https://web.telegram.org/a/" rel="noopener noreferrer">
                <div class="flex items-center gap-2.5 rounded-[12px] border-white/5 bg-white/10 p-4 lg:gap-4 lg:p-5">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                    class="bi bi-messenger" viewBox="0 0 16 16">

                    <path
                      d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.64.64 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.64.64 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76m5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z" />
                  </svg>
                  <span class="font-bold text-gray-300">Messenger</span>
                </div>
              </a>
             </div>
            </div>
          </div>


            <!-- Advertising & Partnership Card -->

          <div class="overflow-hidden rounded-lg !border !border-gray-600 bg-secondary/50 ">
            <div class="border border-white/10 bg-white/10 px-4 py-5 lg:p-6">
              <h2 class="text-2xl text-gray-300 font-extrabold">{{ __('contactPage.advertising_partnership_card') }}</h2>
            </div>


            <div class="space-y-4 p-4 lg:px-6 lg:py-9 ">
                <div class="flex items-center gap-2.5 rounded-[12px] border border-white/5 bg-white/10 p-4 lg:gap-4 lg:p-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-telephone-fill"
                  viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                </svg>
                <span class="font-bold text-gray-300">081 300 400</span>
              </div>

              <div>
                <a href="#" rel="noopener noreferrer" target="_blank" class="block"
                  style="text-decoration: none; color: white;">
                  <div class="flex items-center gap-2.5 rounded-[12px] border-white/5 bg-white/10 p-4 lg:gap-4 lg:p-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white"
                      class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                      <path
                        d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671" />
                      <path
                        d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791" />
                    </svg>

                    <span class="font-bold text-gray-300">info@cinema.com.kh</span>
                  </div>
                </a>
              </div>

            </div>
          </div>

        </div>

      </div>
    </v-container>
  </template>

  <script setup>
  import { __ } from 'matice';

  const items = [
    {
      title: __('home'),
      disabled: false,
      href: route('index'),
    },
    {
      title: __('contact'),
      disabled: true,}
  ]

  </script>

  <style>
  /* Add custom styles here if needed */
  </style>
