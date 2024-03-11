<script setup>
const props = defineProps(['pillName','disableClose'])

const emit = defineEmits(['removeTag'])

function removeTag() {
  emit('removeTag',props.pillName)
}
</script>

<template>
  <li
    class="flex items-center space-x-2 pill px-[10px] py-[3px] border rounded-[30px]"
    @click.prevent="removeTag"
  >
    <p>{{ pillName }}</p>
    <span v-if="!props.disableClose" class="
    bg-red-400 w-[15px]
    h-[15px] flex items-center
    justify-center
    text-sm rounded-[50%]">
      X
    </span>
  </li>
</template>

<style scoped>
input[type='text'] {
  width: 100%;
}

label {
  color: grey;
}

.pill {
  border-color: dodgerblue !important;
  color: dodgerblue;

  span {
    cursor: pointer;
    display: none;
    font-size: 0.8em;
    color: white;
  }

  &:hover {
    span {
      display: flex;
    }
  }
}
</style>
