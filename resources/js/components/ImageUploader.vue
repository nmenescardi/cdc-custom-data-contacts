<template>
    <div class="uploader-container form-group">
        <label
            for="file"
            class="main-label"
            v-if="label"
            v-text="label"
        ></label>
        <div
            class="uploader"
            @dragenter="onDragEnter"
            @dragleave="onDragLeave"
            @dragover.prevent
            @drop="onDrop"
            :class="{ dragging: isDragging }"
        >
            <div class="upload-control" v-show="images.length">
                <label for="file">Select a file</label>
                <button @click="upload">Upload</button>
            </div>

            <div v-show="!images.length">
                <i class="fa fa-cloud-upload"></i>
                <p>Drag your images here</p>
                <div>OR</div>
                <div class="file-input">
                    <label for="file">Select a file</label>
                    <input
                        type="file"
                        name="file"
                        id="file"
                        @change="onInputChange"
                        multiple
                    />
                </div>
            </div>

            <div class="images-preview" v-show="images.length">
                <div
                    class="img-wrapper"
                    v-for="(image, index) in images"
                    :key="index"
                >
                    <div class="close-button" @click="removeImage(index)">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <img :src="image" :alt="`Image Uploader ${index}`" />

                    <div class="details">
                        <span
                            class="name"
                            v-text="truncatedName(files[index].name)"
                        ></span>
                        <span
                            class="size"
                            v-text="getFileSize(files[index].size)"
                        ></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["label"],
    data: () => ({
        isDragging: false,
        dragCount: 0,
        files: [],
        images: []
    }),
    mounted() {
        console.log("label", this.label);
    },
    methods: {
        onDragEnter(e) {
            e.preventDefault();

            this.dragCount++;
            this.isDragging = true;

            return false;
        },
        onDragLeave(e) {
            e.preventDefault();

            this.dragCount--;

            if (this.dragCount <= 0) this.isDragging = false;
        },
        onInputChange(e) {
            const files = e.target.files;

            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;

            const files = e.dataTransfer.files;

            Array.from(files).forEach(file => this.addImage(file));
        },
        addImage(file) {
            if (!file.type.match("image.*")) {
                this.$toastr.e(`${file.name} is not an images`);
                return;
            }

            this.files.push(file);

            const reader = new FileReader();

            reader.onload = e => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        },
        removeImage(index) {
            this.images.splice(index, 1);
            this.files.splice(index, 1);
        },
        getFileSize(size) {
            const fSExt = ["Bytes", "KB", "MB", "GB"];
            let i = 0;

            while (size > 900) {
                size /= 1024;
                i++;
            }
            return `${Math.round(size * 100) / 100} ${fSExt[i]}`;
        },
        upload() {
            const formData = new FormData();
            this.files.forEach(file => {
                formData.append("images[]", file, file.name);
            });

            //TODO: Axios?
        },
        truncatedName(text, limit = 25) {
            if (text.length >= limit) return text.slice(0, limit - 3) + "...";

            return text;
        }
    }
};
</script>

<style lang="scss" scoped>
.uploader {
    width: 100%;
    background: #2196f3;
    color: #fff;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;
    &.dragging {
        background: #fff;
        color: #2196f3;
        border: 3px dashed #2196f3;
        .file-input label {
            background: #2196f3;
            color: #fff;
        }
    }
    i {
        font-size: 85px;
    }
    .file-input {
        width: 200px;
        margin: auto;
        height: 68px;
        position: relative;
        label,
        input {
            background: #fff;
            color: #2196f3;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            border-radius: 4px;
            margin-top: 7px;
            cursor: pointer;
        }
        input {
            opacity: 0;
            z-index: -2;
        }
    }
    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;
        .img-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            margin: 10px;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #3e3737;
            img {
                object-fit: cover;
                width: 200px;
                height: 150px;
            }
        }
        .details {
            font-size: 12px;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: self-start;
            padding: 3px 6px;
            text-align: left;
            .name {
                overflow: hidden;
                height: 18px;
            }
        }
    }
    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 12px;
        text-align: right;
        button,
        label {
            background: #2196f3;
            border: 2px solid #03a9f4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }
        label {
            padding: 2px 5px;
            margin-right: 10px;
            margin-bottom: 0;
        }
    }
    .close-button {
        position: absolute;
        top: 0;
        right: 10px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        i {
            font-size: 12px;
            line-height: 10px;
            font-weight: 600;
            padding: 4px;
        }
    }
}
</style>
