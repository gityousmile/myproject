<!doctype html>
<html>
<script src="../js/vue.js"></script> 
<div id="app"> 
    <span>{{count}}</span> 
    <button @click="inc">+</button> 
</div> 
<script> 
var app = new Vue({ 
  el:'#app',
  data () { 
    return {count: 0} 
  }, 
  methods: { 
    inc () {this.count++} 
  } 
}) 

</script>  
</html>