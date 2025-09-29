<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&family=Lora:wght@400;600&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            pastel: {
              bg: '#fdf6f0',
              primary: '#ff8c69',
              primaryHover: '#ff7043',
              accent: '#ffd8cc',
              text: '#6d5d52',
              textSecondary: '#938278',
              textMuted: '#b5a9a2',
              textHeading: '#5c4d44',
              border: '#ffe8d9',
              inputBorder: '#ffe0c2',
              input: '#fffefc'
            }
          },
          fontFamily: {
            sans: ['Nunito Sans', 'sans-serif'],
            serif: ['Lora', 'serif']
          },
          boxShadow: {
            'pastel-sm': '0 3px 6px rgba(180, 160, 150, 0.08)',
            'pastel-md': '0 6px 12px rgba(180, 160, 150, 0.1)',
            'pastel-lg': '0 10px 20px rgba(180, 160, 150, 0.12)'
          }
        }
      }
    }
  </script>
</head>
<body class="bg-pastel-bg font-sans text-pastel-text min-h-screen flex items-center justify-center p-5">

  <div class="flex rounded-2xl overflow-hidden shadow-pastel-lg bg-white border border-pastel-border w-full max-w-5xl">
    <!-- Left Panel -->
    <div class="relative flex-1 hidden md:flex flex-col items-center justify-center p-10 text-center bg-pastel-accent text-pastel-textHeading">
      <img src="https://images.unsplash.com/photo-1579546929662-711aa81148cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Soft pastel background" class="absolute inset-0 w-full h-full object-cover opacity-30">
      <div class="relative z-10">
        <h3 class="text-2xl font-serif font-semibold mb-4">Welcome to Your Space</h3>
        <p class="text-base opacity-90">A peaceful place to connect, create, and collaborate.</p>
      </div>
    </div>
    
    <!-- Right Panel (Form) -->
    <div class="flex-1 p-6 md:p-10 bg-white">
      <h3 class="text-2xl font-serif font-semibold text-pastel-textHeading text-center mb-6">Access Your Portal</h3>

      {{-- Error messages --}}
      @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Laravel Login Form --}}
      <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-5">
          <label for="admin_id" class="block font-medium text-pastel-textSecondary text-sm mb-2">Operator ID</label>
          <input 
            type="text" 
            name="admin_id" 
            id="admin_id" 
            class="w-full p-3 rounded-xl border border-pastel-inputBorder bg-pastel-input text-pastel-text shadow-pastel-sm focus:outline-none focus:ring-2 focus:ring-pastel-primary/30 focus:border-pastel-primary transition-all"
            placeholder="Enter your Operator ID" 
            required
          >
        </div>
        
        <div class="mb-5">
          <label for="admin_password" class="block font-medium text-pastel-textSecondary text-sm mb-2">Auth Key</label>
          <input 
            type="password" 
            name="admin_password" 
            id="admin_password" 
            class="w-full p-3 rounded-xl border border-pastel-inputBorder bg-pastel-input text-pastel-text shadow-pastel-sm focus:outline-none focus:ring-2 focus:ring-pastel-primary/30 focus:border-pastel-primary transition-all"
            placeholder="Enter your Auth Key" 
            required
          >
        </div>
        
        <div class="flex justify-between items-center mb-5 text-sm">
          {{-- <label class="flex items-center text-pastel-textSecondary cursor-pointer">
            <input type="checkbox" class="w-4 h-4 rounded mr-2 border-pastel-inputBorder text-pastel-primary focus:ring-pastel-primary/30">
            Secure session
          </label> --}}
          <a href="#" class="text-pastel-primary font-medium hover:underline">Auth Issues?</a>
        </div>
        
        <button 
          type="submit" 
          class="w-full py-3 px-4 bg-pastel-primary text-white font-medium rounded-xl shadow-pastel-sm hover:bg-pastel-primaryHover hover:shadow-pastel-md transform hover:-translate-y-0.5 transition-all"
        >
          Connect
        </button>
        
        <p class="text-center mt-6 text-sm text-pastel-textSecondary">
          Need clearance? <a href="#" class="text-pastel-primary font-medium hover:underline">Request Access</a>
        </p>
      </form>
    </div>
  </div>

</body>
</html>
