<div>
  <div
      x-data="{
          observe () {
              let observer = new IntersectionObserver((entries) => {
                  entries.forEach(entry => {
                      if (entry.isIntersecting) {
                          @this.call('loadMore')
                      }
                  })
              }, {
                  root: null
              })

              observer.observe(this.$el)
          }
      }"
      x-init="observe"
  ></div>
  <div class="flex justify-center">
    <img  wire:loading loading="lazy" class="" src="https://listing-app.s3.ap-south-1.amazonaws.com/public/loader.gif">
  </div>
</div>