module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors :{
        'theme': '#f5f5f5'
      },
      margin: {
        'neg-4/5': '-80%',
        
      },
      inset: {
        '-80%': '-80%',
        '-100' : '-100%', 
        '65px' : '65px'    
      }
      
    },
    container: {
      center: true,
      padding : '1rem'
    },
    screens: {
      sm : '640px',  
      md: '768px',  
      lg: '1280px',
      xl: '1280px',   
    },
  },
  plugins: [],
}
