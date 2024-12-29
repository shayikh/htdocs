const deleteComment = (comment_id, unique_id_me, elm) => {

    let delComment = {};

    delComment.comment_id = comment_id;
    delComment.unique_id_me = unique_id_me;

    axios.post("../api/comment/deleteComment.php",
    delComment, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(res.data);

        if (res.data == 1) {
            elm.parentElement.parentElement.remove();
            toastr.info('Comment Deleted');
        } else {
            toastr.warning("You Can not Delete Other's Comment");
        }

    })
    .catch(err => {
        console.log(err);
    })

}


const clearModal = () => {
    commentTboody.innerHTML = "";
    postlinkforwardTboody.innerHTML = "";
}


const showCommentfn = (post_id) => {

    let showComment = {};

    showComment.post_id = post_id;

    axios.post("../api/comment/showComments.php",
    showComment, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {

        // console.log(res.data);

        let all = res.data;

        all.forEach(comment => {
            commentTboody.innerHTML = commentTboody.innerHTML + makeCommentTr(comment);
        })


    })
    .catch(err => {
        console.log(err);
    })

}


const forwardfn = (unique_id_fr, post_id, unique_id_me, elm) => {

    let commentp = {};

    commentp.unique_id_fr = unique_id_fr;
    commentp.post_id = post_id;
    commentp.unique_id_me = unique_id_me;

    axios.post("../api/postLinkForward/forwardFr.php",
    commentp, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(elm);

        if (res.data == 1) {
            elm.parentElement.parentElement.remove();
            toastr.success("Post Link Forwarded");
        }


    })
    .catch(err => {
        console.log(err);
    })
}


const forwardMefn = (unique_id_fr, post_id, unique_id_me, elm) => {

    let commentp = {};

    commentp.unique_id_fr = unique_id_fr;
    commentp.post_id = post_id;
    commentp.unique_id_me = unique_id_me;

    axios.post("../api/postLinkForward/forwardMe.php",
    commentp, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(elm);

        if (res.data == 1) {
            elm.parentElement.parentElement.remove();
            toastr.success("Post Link Forwarded to Yourself");
        }


    })
    .catch(err => {
        console.log(err);
    })

}



const forwardGrpfn = (grp_id, post_id, unique_id_me, elm) => {

    let commentp = {};

    commentp.grp_id = grp_id;
    commentp.post_id = post_id;
    commentp.unique_id_me = unique_id_me;

    axios.post("../api/postLinkForward/forwardGrp.php",
    commentp, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(elm);

        if (res.data == 1) {
            elm.parentElement.parentElement.remove();
            toastr.success("Post Link Forwarded to Yourself");
        }


    })
    .catch(err => {
        console.log(err);
    })


}



const commentfn = (elm, post_id, post_giver_id, comn_giver_id) => {

    let comment = elm.nextElementSibling.value;

    if (comment == "") {
        toastr.error("Comment is Empty");
    } else {


        let commentp = {};

        commentp.comment = comment;
        commentp.post_id = post_id;
        commentp.post_giver_id = post_giver_id;
        commentp.comn_giver_id = comn_giver_id;


        axios.post("../api/comment/comment.php",
        commentp, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(elm);

            if (res.data == 1) {
                elm.nextElementSibling.value = '';
                toastr.success("Comment Done");
            }


        })
        .catch(err => {
            console.log(err);
        })

    }


}



const likefn = (post_id, unique_id_me, elm) => {
    let likep = {};

    likep.post_id = post_id;
    likep.unique_id_me = unique_id_me;

    axios.post("../api/post/like_post.php",
    likep, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(elm);

        if (res.data == 1) {
            elm.style.color = '#0D6EFD';
            elm.nextElementSibling.style.color = '#fff';
        } else {
            elm.style.color = '#fff';
        }


    })
    .catch(err => {
        console.log(err);
    })
}


const dislikefn = (post_id, unique_id_me, elm) => {
    let dislikep = {};

    dislikep.post_id = post_id;
    dislikep.unique_id_me = unique_id_me;

    axios.post("../api/post/dislike_post.php",
    dislikep, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(elm);

        if (res.data == 1) {
            elm.style.color = '#0D6EFD';
            elm.previousElementSibling.style.color = '#fff';
        } else {
            elm.style.color = '#fff';
        }


    })
    .catch(err => {
        console.log(err);
    })
}


const sharefn = (post_id, unique_id_me) => {
    let confirm = window.confirm("Share This Post to Your Timeline?");

    if (confirm) {
        let sharep = {};

        sharep.post_id = post_id;
        sharep.unique_id_me = unique_id_me;

        axios.post("../api/post/share.php",
        sharep, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {

            let json = res.data;

            let unique_id_me = json.unique_id_me;
            let newPost = json.newPost;

            tbody.innerHTML = makeTr(newPost, unique_id_me) + tbody.innerHTML;

            toastr.success('Post Shared');


        })
        .catch(err => {
            console.log(err);
        })

    } else {
        return;
    }

}


const followfn = (unique_id_me, unique_id_fr, elm) => {

    let followVar = {};

    followVar.unique_id_me = unique_id_me;
    followVar.unique_id_fr = unique_id_fr;

    axios.post("../api/facelist/follow.php",
            followVar, {
                headers: {
                    "Content-Type": "application/json"
                }
            })
        .then(res => {
            // console.log(res.data);

            if (res.data == 0) {
                toastr.error('Unfollowed');
                elm.innerHTML = '<i class="fas fa-user-plus"></i>';
                elm.classList.add('btn-success');
                elm.classList.remove('btn-danger');
            } else {
                toastr.success('Following');
                elm.innerHTML = '<i class="fas fa-user-slash"></i>';
                elm.classList.add('btn-danger');
                elm.classList.remove('btn-success');
            }


        })
        .catch(err => {
            console.log(err);
        })
}


const shareMefn = (post_id, unique_id_me) => {
    let confirm = window.confirm("Share This Post to Your Timeline?");

    if (confirm) {
        let sharep = {};

        sharep.post_id = post_id;
        sharep.unique_id_me = unique_id_me;

        axios.post("../api/post/share.php",
                sharep, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {

                toastr.success('Post Shared to Your Timeline');

            })
            .catch(err => {
                console.log(err);
            })

    } else {
        return;
    }
}


const deletePost = (post_id, unique_id_me, elm) => {
    let confirm = window.confirm("Are You Sure?");

    if (confirm) {

        let delPost = {};

        delPost.post_id = post_id;
        delPost.unique_id_me = unique_id_me;

        axios.post("../api/post/deletePost.php",
                delPost, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == 1) {
                    elm.parentElement.parentElement.remove();
                    toastr.error('Post Deleted');
                } else {
                    toastr.error('This is not Your Post');
                }

            })
            .catch(err => {
                console.log(err);
            })

    } else {
        return;
    }

}