<script setup>
import Navigation from "@/components/FrontEnd/navigation.vue";

</script>

<template>
  <navigation class="mb-[20px]"></navigation>
  <div class="container flex items-center justify-center p-[10px]">
<!--    <div class="ad-space" data-placement-id="1" ></div>-->
    <div class="ad-space" data-placement-id="2" ></div>
  </div>
  <div class="container mb-[20px]">
    <h1 class="text-[1.4em] text-gray-700 font-semibold underline mb-[10px]">Article Title</h1>
  </div>
  <div class="flex space-x-[30px] container">
    <div class="article-container border p-[10px] rounded  w-3/4">
      <h3>One</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi dolorem doloribus eos fuga illo, ipsum laborum
        laudantium nobis non quaerat, quam quidem repellendus reprehenderit saepe sed sint tempore velit voluptas. Lorem
        ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad asperiores assumenda at, distinctio dolorum in,
        libero molestiae neque numquam odio officia officiis perspiciatis quae, quaerat quam sunt vero voluptatum. Lorem
        ipsum dolor sit amet, consectetur adipisicing elit. Commodi consequuntur distinctio, eaque explicabo neque nulla
        quibusdam sit tempora! Animi autem consequuntur eveniet incidunt non similique. Ab consequatur nesciunt reiciendis
        veniam? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur dolore doloribus facere
        inventore ipsam laudantium maxime minima molestias mollitia non perspiciatis possimus quam qui, quis sint velit
        voluptatem voluptatibus!</p>
      <div>
      </div>
      <h3>One</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias animi dignissimos mollitia natus, placeat
        quasi quibusdam quo repudiandae saepe sit sunt. Amet animi cupiditate doloremque dolorum error eum neque! Lorem
        ipsum dolor sit amet, consectetur adipisicing elit. Cum error eveniet ipsa laboriosam magni repellendus! Alias
        consequatur dolore doloremque maxime molestiae nobis nulla porro, qui quidem similique, tenetur, ullam voluptatem!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam aspernatur assumenda, deserunt dicta,
        distinctio dolorum ea est ex id ipsum molestias natus obcaecati quod reprehenderit sint sit soluta unde! Lorem
        ipsum dolor sit amet, consectetur adipisicing elit. Esse fugit inventore libero non perspiciatis saepe soluta ut.
        Eveniet quod tempore tenetur. Corporis impedit laboriosam, non omnis pariatur quas ullam ut!</p>
      <h3>One</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias aliquam aliquid atque autem beatae
        deleniti dolore dolorum ducimus error et, fugit laudantium magnam quae repellendus soluta ut vitae voluptatem.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid laborum nesciunt nihil nulla perferendis sit vel
        voluptatem. Aliquam atque dolor dolores eaque et, ex fuga natus necessitatibus neque non praesentium. Lorem ipsum
        dolor sit amet, consectetur adipisicing elit. Aperiam cum hic impedit molestiae natus obcaecati pariatur possimus
        quidem ratione temporibus, unde velit veritatis voluptate. A accusamus alias blanditiis ea tenetur! Lorem ipsum
        dolor sit amet, consectetur adipisicing elit. Doloremque facere fuga iusto molestiae omnis quibusdam quo
        repellendus sed! Accusamus beatae ea exercitationem expedita id laboriosam molestiae nemo pariatur quidem
        saepe?</p>
      <h3>One</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, atque blanditiis cumque delectus, enim
        error, facilis illum iure laborum laudantium officia perferendis praesentium quis soluta voluptates? Adipisci aut
        quo tempore. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda itaque laboriosam similique
        vitae? Beatae eius, et, eveniet exercitationem expedita explicabo iste itaque molestias provident quae quia quod
        similique totam voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, blanditiis dicta
        dolore dolorem eius enim esse, inventore iure laboriosam maxime nihil quis quod! Asperiores est in possimus, sequi
        totam ullam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aspernatur blanditiis error facere,
        magnam maxime, perspiciatis placeat recusandae repellendus saepe sequi tempora. Ad consequuntur culpa ipsa iste
        perferendis quibusdam tempore?</p>

    </div>
    <div class="w-1/4">
      <div class="h-[300px] w-[100%] border rounded-md mb-[20px] p-[10px]" >
        <h1 class="font-semibold underline">Side Bar One</h1>
      </div>

      <div class="h-[300px] w-[100%] border rounded-md mb-[20px] p-[10px]" >
      </div>

      <div class="h-[300px] w-[100%] border rounded-md mb-[20px] p-[10px]" >
        <h1 class="font-semibold underline">Side Bar One</h1>
      </div>

      <div class="h-[300px] w-[100%] border rounded-md mb-[20px] p-[10px]" >
        <h1 class="font-semibold underline">Side Bar One</h1>
      </div>

      <div class="h-[300px] w-[100%] border rounded-md mb-[20px] p-[10px]" >
        <h1 class="font-semibold underline">Side Bar One</h1>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.ad-space{
  @apply max-h-[200px];

  img{
    @apply max-h-[200px];
  }
}
</style>