@extends('layouts.auth')

@section('content')

<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center justify-content-center row-login">
                <div class="col-lg-4">
                    <h2>
                      Memulai membeli dengan cara terbaru.
                  </h2>
                    <form action="{{ route('register') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <input 
                      name="name"
                      type="text"
                      class="form-control @error('name') is-invalid @enderror" 
                      placeholder="Masukan Nama Lengkap"
                      v-model="name"
                      value="{{ old('name') }}" 
                      required 
                      autocomplete="name" 
                      autofocus
                      />
                                    @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                    </div>
                    <div class="form-group">
                      <label>Alamat Email</label>
                      <input 
                        type="email"
                        name="email"
                        @change="checkForEmailAvailability()"
                        class="form-control  @error('email') is-invalid @enderror"
                        :class="{ 'is-invalid' : this.email_unavailable }"
                        placeholder="Masukan Email"
                        v-model="email"
                        required
                        autocomplete="email"
                        />

                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input 
                        type="password" 
                        name="password" 
                        placeholder="Masukan Password" 
                        autocomplete="new-password" 
                        class="form-control @error('password') is-invalid @enderror"
                        required
                        />
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                      </div>
                      <div class="form-group">
                      <label>Konfirmasi Password</label>
                          <input 
                          type="password" 
                          id="password_confirm" 
                          name="password_confirmation" 
                          placeholder="Masukan Password Lagi" 
                          autocomplete="new_password" 
                          required 
                          class="form-control @error('password_confirmation') is-invalid @enderror"
                          />
                                  @error('password_confirmation')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                      </div>
                    <button 
                      type="submit" 
                      class="btn btn-success btn-block  mt-4"
                      :disabled="this.email_unavailable"
                    >
                      Daftar Sekarang
                    </button>
                    <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                      Kembali ke Login
                    </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);
      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
       
         },
        methods: {
          checkForEmailAvailability: function(){
            var self = this;
            axios.get('{{ route('api-register-check') }}', {
                params: {
                  email: this.email
                }
              })
              .then(function (response) {
                // Handle Success
                if(response.data == "Available"){
                      self.$toasted.show(
                        "Email Anda Tersedia,Silahkan lanjutkan langkah pendaftaran.",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 1000,
                        }
                      );
                      self.email_unavailable = false ;
                }else{
                      self.$toasted.error(
                        "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                        {
                          position: "top-center",
                          className: "rounded",
                          duration: 1000,
                        }
                      );
                      self.email_unavailable = true;
                }
                console.log(response);
              });
              
          }
        },
        data() {
          return{
            name: "",
            email: "",
            email_unavailable:false
          }
        },
      });
    </script>
@endpush
