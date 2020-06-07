<template>
  <div class="media-display">
    <button @click="prev" class="button prev">Prev</button>
    <button @click="shuffle" class="button shuffle">Shuffle</button>
    <button @click="next" class="button next">Next</button>

    <transition-group name="flip-list" class="media-gallery">
      <figure
        class="media-post"
        v-for="(image, i) in images"
        :key="image"
        @click="shift(image)"
        :style="{
                '--i': i,
                '--flip-delay': images.lenght - i
            }"
      >
        <img :src="image" alt="contact" width="400" height="400" />
        <figcaption>{{i+1}}</figcaption>
      </figure>
    </transition-group>
  </div>
</template>


<script>
export default {
  data() {
    return {
      images: [
        "https://source.unsplash.com/ZVKr8wADhpc/400x400",
        "https://source.unsplash.com/zNU3ErDAbAw/400x400",
        "https://source.unsplash.com/x-rqS-3Qi10/400x400",
        "https://source.unsplash.com/tR-hmR1ZGmE/400x400",
        "https://source.unsplash.com/N8ldzkCZ7yY/400x400",
        "https://source.unsplash.com/KZa4fREZoKk/400x400",
        "https://source.unsplash.com/gR_AgAcP7jI/400x400",
        "https://source.unsplash.com/aG6ByqGXiXg/400x400",
        "https://source.unsplash.com/Y3quvtI_LJE/400x400"
      ]
    };
  },
  methods: {
    prev() {
      this.images.unshift(this.images.pop());
    },
    shuffle() {
      this.images = this.images.sort(() => 0.5 - Math.random());
    },
    next() {
      this.images.push(this.images.shift());
    },
    shift(image) {
      this.images.splice(this.images.indexOf(image), 1);
      this.images.unshift(image);
    }
  }
};
</script>


<style scoped>
.flip-list-move {
  transition: -webkit-transform 0.5s cubic-bezier(0.5, 0, 0.5, 1);
  transition: transform 0.5s cubic-bezier(0.5, 0, 0.5, 1);
  transition: transform 0.5s cubic-bezier(0.5, 0, 0.5, 1),
    -webkit-transform 0.5s cubic-bezier(0.5, 0, 0.5, 1);
  transition-delay: calc(var(--flip-delay) * 50ms);
}

.button {
  border: none;
  color: #fff;
  background: #42b983;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  font: inherit;
  font-size: 1.25rem;
  padding: 0.5em 1em;
  border-radius: 0.3em;
  cursor: pointer;
}

.shuffle {
  color: #2c3e50;
  background: #fff;
}

.media-gallery {
  display: block;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  grid-gap: 2rem;
  margin: 1rem auto;
  width: 80vmin;
  position: relative;
}

.media-post {
  display: inline-block;
  padding: 1vmin;
  border-radius: 2vmin;
  box-shadow: 0 10px 5px rgba(0, 0, 0, 0.2);
  margin: 0;
  background: #fff;
  position: relative;
  cursor: pointer;
}
.media-post img {
  border-radius: 1vmin;
  display: block;
  max-width: 100%;
  height: auto;
}
.media-post figcaption {
  color: #fff;
  position: absolute;
  top: 0;
  left: 0;
  font-weight: bold;
  padding: 1rem 1.5rem;
  z-index: 2;
  font-size: 2rem;
  text-shadow: 0 1px 2px #000;
}
</style>
