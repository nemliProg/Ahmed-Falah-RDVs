<template>
  <footer>
    <p>&copy; 2021 AFRdvs. All rights reserved</p>
    <div class="social-icons">
      <span><a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"><img src="../assets/social/Social_Icons.png" alt="" /></a></span>
      <span><a href="http://dribbble.com" target="_blank" rel="noopener noreferrer"><img src="../assets/social/Social_Icons-1.png" alt="" /></a></span>
      <span><a href="https://twitter.com/" target="_blank" rel="noopener noreferrer"><img src="../assets/social/Social_Icons-2.png" alt="" /></a></span>
      <span><a href="http://youtube.com" target="_blank" rel="noopener noreferrer"><img src="../assets/social/Social_Icons-3.png" alt="" /></a></span>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style lang="scss">
  footer{
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 10px 10%;
    background-color: $primary-color;
    display: flex;
    justify-content: space-between;
    align-items: center;
    p{
      font-size: .9rem;
      font-weight: 200;
      color: white;
    }
    .social-icons {
      display: flex;
      gap: 10px;
    }
  }
</style>