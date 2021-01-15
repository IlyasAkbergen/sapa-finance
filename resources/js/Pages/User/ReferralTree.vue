<template>
  <Tree :value="treeData" />
</template>

<script>
import 'he-tree-vue/dist/he-tree-vue.css'
import { Tree, Draggable } from 'he-tree-vue'

export default {
  name: "ReferralTree",
  components: {
    Tree: Tree.mixPlugins([Draggable])
  },
  props: {
    data: Object
  },
  data() {
    return {
      treeData: [{text: 'node 1'}, {text: 'node 2', children: [{text: 'node 2-1'}]}]
    }
  }
}
</script>
