<div class="rounded-lg border border-gray-200 bg-white shadow">
    <a href="#">
        <img class="rounded-t-lg" src="https://pollingjatim.com/assets/image/newpaslon1.png
        " alt="" />
    </a>
    <div class="p-5">
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Calon Nomor Urut {{$id}}</h5>
        </a>
        <p class="mb-4 font-normal text-gray-700">{{$paslon}}</p>
        <div class="flex flex-col items-start gap-x-2 gap-y-2 xl:flex-row">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="inline-flex items-center rounded-lg bg-white px-3 py-2 text-center text-sm font-medium text-blue-700 ring-1 ring-blue-700 transition-colors duration-200 hover:bg-blue-700 hover:text-white">
                Lihat Visi & Misi
                <svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </button>
            <button onclick="handleVote({{$candidateId}})" class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white transition-colors duration-200 hover:bg-blue-900">
                Pilih Calon Nomor Urut {{$id}}
            </button>
        </div>
    </div>
</div>

  <!-- Main modal -->
  <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Terms of Service
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                      With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                  </p>
                  <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                      The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                  </p>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                  <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
              </div>
          </div>
      </div>
  </div>
  

<script>
    function handleVote(id) {
        $.ajax({
            url: '{{ route('vote.store') }}',
            type: 'POST',
            data: {
                candidate_id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response)
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses Memilih',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.reload();
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memilih',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                window.location.reload();
            },
            error : function(error) {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memilih',
                    text: error.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                window.location.reload();
            },
        });
    }
</script>
