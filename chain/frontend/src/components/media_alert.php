<style>
    .media-container{
        font-family: sans-serif;
        color: #ffffff;
        max-width: 410px;
        width: 310px;
        border-radius: 10px;
        transition: all 0.5s ease;
        position: fixed;
        bottom: 20px;
        right: 10px;
        z-index: 1000;
        
        .media{
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: space-between;
            background-color: #34c38f !important;
            padding: 1rem;
            transition: all 0.5s ease;



            > div:nth-of-type(1){
                display: flex;
                gap: 20px;

                .avatar{
                    width: 40px;
                    height: 40px;
                    background-color: black;
                    border-radius: 10px;

                    span{
                        width: 100%;

                        img{
                            border-radius: 10px;
                            height: 100%;
                            width: 100%;
                        }
                    }
                }

                .media-body{
                    padding: 0;
                    display: flex;
                    flex-direction: column;
                    gap: 5px;

                    p{
                        padding: 0;
                        margin: 0;
                        font-weight: 600;
                    }

                    .time{
                        font-size: 13px;
                    }
                }

            }
            .close-icon{
                cursor: pointer;
            }
        }


    }

    .media.success  {
      background: var(--positive-text-clr);
    }

    .media.error  {
      background: var(--negative-text-clr);
    }
    .media.info {
      background: var(--info-clr);
    }

    .media.show {
            transform: translateX(0);
            transition: all 0.5s ease;
    }

    .media.hide {
        transform: translateX(190%);
        transition: all 0.5s ease;
    }
</style>
<div class="media-container" id="mediaContainer">


</div>

<script>
    



    // const $mediaContainer = $('#mediaContainer');
    const activeMedias = new Set();

    function createMedia(type, message) {
        const $media = $(`
                <div class="wrapper media ${type}">
                    <div>
                        <div class="avatar">
                            <span>
                                <img src="/chain-fortune/images/hunter-hamilton.jpg" style="max-width: 100%;" alt="">
                            </span>
                        </div>
                        <div class="media-body">
                            <p>${message}</p>
                            <span class="time">24 min ago</span>
                        </div>
                    </div>
                    <div class="close-icon dismiss-btn">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                        </span>
                    </div>
                </div>
        `);

        $media.find('.dismiss-btn').on('click', function () {
            dismissMedia($media);
        });

        return $media;
    }

    function dismissMedia($media) {
        $media.addClass('hide')
    }

    function showMedia(type, message) {
        const $media = createMedia(type, message);
        $('#mediaContainer').append($media);
        activeMedias.add($media);

        $media[0].offsetHeight; 
        $media.addClass('show');

        // setTimeout(() => dismissMedia($media));
    }

</script>