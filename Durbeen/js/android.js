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
    commentTbody.innerHTML = "";
    postlinkforwardTboody.innerHTML = "";
}

const clearMsgForwardModal = () => {
    messageForwardTbody.innerHTML = "";
}

const removeLikefn = (like_id, elm) => {

    let removeLike = {};

    removeLike.like_id = like_id;

    axios.post("../api/about_update/removeLike.php",
        removeLike, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {

        // console.log(res.data);
        if(res.data == 1){
            elm.parentElement.parentElement.remove();
            toastr.success("Like Removed");
        }

    })
    .catch(err => {
        console.log(err);
    })

}

const removeDisLikefn = (dislike_id, elm) => {

    let removeDisLike = {};

    removeDisLike.dislike_id = dislike_id;

    axios.post("../api/about_update/removeDisLike.php",
        removeDisLike, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {

        // console.log(res.data);
        if(res.data == 1){
            elm.parentElement.parentElement.remove();
            toastr.success("Like Removed");
        }

    })
    .catch(err => {
        console.log(err);
    })

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
            commentTbody.innerHTML = commentTbody.innerHTML + makeCommentTr(comment);
        })


    })
    .catch(err => {
        console.log(err);
    })

}


const forwardPostLinkToMefn = (unique_id_fr, post_id, unique_id_me, elm) => {

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



const forwardPostLinkToGrpfn = (grp_id, post_id, unique_id_me, elm) => {

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




const forwardPostLinkToFriendfn = (unique_id_fr, post_id, unique_id_me, elm) => {

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


const forwardMessagefn = (typical_id, from_id, to_id, message_id, unique_id_me, elm) => {

    let commentp = {};

    commentp.typical_id = typical_id;
    commentp.to_id = to_id;
    commentp.from_id = from_id;
    commentp.message_id = message_id;
    commentp.unique_id_me = unique_id_me;

    axios.post("../api/messageForward/forward.php",
    commentp, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        console.log(res.data);

        if (res.data == 1) {
            elm.parentElement.parentElement.remove();
            toastr.success("Message Forwarded to Your Friend");
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

const unfollowfn = (unique_id_me, unique_id_fr, elm) => {
    let confirm = window.confirm("Do You Want to Unfollow?");

    if (confirm) {

        let unfollowVar = {};

        unfollowVar.unique_id_me = unique_id_me;
        unfollowVar.unique_id_fr = unique_id_fr;

        axios.post("../api/facelist/unfollow.php",
        unfollowVar, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == 0) {
                elm.parentElement.parentElement.remove();
                toastr.error('Unfollowed');
            }


        })
        .catch(err => {
            console.log(err);
        })

    } else {
        return;
    }


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
    let confirm = window.confirm("Do You Want to Delete This Post?");

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



const leaveGrp = (grp_id, unique_id_me) => {
    let confirm = window.confirm("Do You Want to Leave From This Group?");

    if (confirm) {

        let message = {};

        message.grp_id = grp_id;
        message.unique_id_me = unique_id_me;

        axios.post("../api/group/leaveGrp.php",
                message, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {
                // console.log(res.data);

                if (res.data == '1') {
                    window.location = './groups.php?type=groups';
                }else if (res.data == '0') {
                    alert('You Are The Only Admin in This Group. If You Leave, The group Will be Adminless. So You Cannot Leave This Group Until You Make One or More Admin');
                    toastr.error('You Are The Only Admin in This Group. If You Leave, The group Will be Adminless. So You Cannot Leave This Group Until You Make One or More Admin');
                }

            })
            .catch(err => {
                console.log(err);
            })
    } else {
        return;
    }
}


const adminfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

    let addVar = {};

    addVar.unique_id_me = unique_id_me;
    addVar.unique_id_fr = unique_id_fr;
    addVar.grp_id = grp_id;

    axios.post("../api/group/make_admin.php",
    addVar, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(res.data);

        if (res.data == 0) {
            toastr.error('Removed from Admin');
            elm.innerHTML = '<i class="fas fa-user-cog"></i>';
            elm.classList.add('btn-success');
            elm.classList.remove('btn-danger');
        } else {
            toastr.success('Made Admin');
            elm.innerHTML = '<i class="fas fa-users"></i>';
            elm.classList.add('btn-danger');
            elm.classList.remove('btn-success');
        }


    })
    .catch(err => {
        console.log(err);
    })
}


const addfn = (unique_id_me, unique_id_fr, grp_id, elm) => {

    let addVar = {};

    addVar.unique_id_me = unique_id_me;
    addVar.unique_id_fr = unique_id_fr;
    addVar.grp_id = grp_id;

    axios.post("../api/group/add.php",
    addVar, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(res.data);

        if (res.data == 0) {
            toastr.error('Removed');
            elm.innerHTML = '<i class="fas fa-user-plus"></i>';
            elm.classList.add('btn-success');
            elm.classList.remove('btn-danger');
        } else {
            toastr.success('Added');
            elm.innerHTML = '<i class="fas fa-user-minus"></i>';
            elm.classList.add('btn-danger');
            elm.classList.remove('btn-success');
        }


    })
    .catch(err => {
        console.log(err);
    })
}


const cleanGrp = (grp_id) => {
    let confirm = window.confirm("Do You Want to Clear This Group Messages?");

    if (confirm) {

        let message = {};

        message.grp_id = grp_id;

        axios.post("../api/group/cleanGrp.php",
        message, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                window.location = './groups.php?type=groups';
            }

        })
        .catch(err => {
            console.log(err);
        })
    } else {
        return;
    }
}


const deleteProPic = (pro_pic_id, unique_id_me, elm) => {
    let confirm = window.confirm("Do You Want to Delete?");

    if (confirm) {

        let delProPic = {};

        delProPic.pro_pic_id = pro_pic_id;
        delProPic.unique_id_me = unique_id_me;

        axios.post("../api/pro_pic/deleteProPic.php",
        delProPic, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            elm.parentElement.parentElement.remove();
            toastr.error('Profile Picture Deleted');

        })
        .catch(err => {
            console.log(err);
        })

    } else {
        return;
    }

}


const makeProPic = (pro_pic_id, unique_id_me, elm) => {

    let delProPic = {};

    delProPic.pro_pic_id = pro_pic_id;
    delProPic.unique_id_me = unique_id_me;

    axios.post("../api/pro_pic/makeProPic.php",
    delProPic, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(res.data);

        timeline_pro_pic.src = "../pro_pic/" + res.data.new_pro_pic;

        elm.parentElement.previousElementSibling.firstElementChild.src = "../pro_pic/" + res.data.oldProPic.pro_pic;

        toastr.success('Profile Picture Changed');

    })
    .catch(err => {
        console.log(err);
    })

}


const deleteCovPic = (cov_pic_id, unique_id_me, elm) => {
    let confirm = window.confirm("Do You Want to Delete?");

    if (confirm) {

        let delCovPic = {};

        delCovPic.cov_pic_id = cov_pic_id;
        delCovPic.unique_id_me = unique_id_me;

        axios.post("../api/cov_pic/deleteCovPic.php",
        delCovPic, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            elm.parentElement.parentElement.remove();
            toastr.error('Cover Photo Deleted');

        })
        .catch(err => {
            console.log(err);
        })

    } else {
        return;
    }

}


const makeCovPic = (cov_pic_id, unique_id_me, elm) => {

    let delCovPic = {};

    delCovPic.cov_pic_id = cov_pic_id;
    delCovPic.unique_id_me = unique_id_me;

    axios.post("../api/cov_pic/makeCovPic.php",
    delCovPic, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        // console.log(res.data);

        elm.parentElement.previousElementSibling.firstElementChild.src = "../pro_pic/cov_pic/" + res.data.oldCovPic.cov_pic;

        toastr.success('Cover Photo Changed');

    })
    .catch(err => {
        console.log(err);
    })

}


const cleanNotes = (unique_id_me) => {
    let confirm = window.confirm("Do You Want to Clear Your Notes?");

    if (confirm) {

        let message = {};

        message.unique_id_me = unique_id_me;

        axios.post("../api/my_notes/cleanNotes.php",
        message, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                window.location = './my_notes.php?type';
            }

        })
        .catch(err => {
            console.log(err);
        })
    } else {
        return;
    }
}


const deleteMyNotes = (id_lll, unique_id_me, elm_ppp) => {
    let confirm = window.confirm("Do You Want to Delete?");

    if (confirm) {

        let message = {};

        message.id = id_lll;
        message.unique_id_me = unique_id_me;

        axios.post("../api/my_notes/delete_my_notes.php",
        message, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                toastr.error('Message Deleted')
            }

            elm_ppp.parentElement.remove();

        })
        .catch(err => {
            console.log(err);
        })
    } else {
        return;
    }



}


const deleteConv = (unique_id_me, unique_id_fr) => {
    let confirm = window.confirm("Do You Want to Delete This Conversation?");

    if (confirm) {

        let message = {};

        message.unique_id_me = unique_id_me;
        message.unique_id_fr = unique_id_fr;

        axios.post("../api/message/deleteConv.php",
        message, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                window.location = './homepage.php?type';
            }
            
        })
        .catch(err => {
            console.log(err);
        })
    } else {
        return;
    }
}


const unsendMessage = (id_lll, unique_id_me, unique_id_fr, elm_ppp) => {
    let confirm = window.confirm("Do You Want to Unsend?");

    if (confirm) {
        let message = {};

        message.id = id_lll;
        message.unique_id_me = unique_id_me;
        message.unique_id_fr = unique_id_fr;

        axios.post("../api/message/unsend.php",
        message, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                toastr.error('Message Deleted For Everyone')
            }

            elm_ppp.parentElement.remove();

        })
        .catch(err => {
            console.log(err);
        })

    } else {
        return;
    }

}



const unsendGrpMessage = (id_msg, grp_id, elm_ppp) => {
    let confirm = window.confirm("Do You Want to Unsend?");
    if (confirm) {
        let unsendData = {};

        unsendData.id_msg = id_msg;
        unsendData.grp_id = grp_id;

        axios.post("../api/group_msg/unsend.php",
        unsendData, {
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(res => {
            // console.log(res.data);

            if (res.data == '1') {
                toastr.error('Message Deleted For Everyone')
            }else{
                toastr.error('Message not deleted')
            }

            elm_ppp.parentElement.remove();

        })
        .catch(err => {
            console.log(err);
        })
    }

}


function deletefn() {
    let data = confirm('Are You Sure You Want to Delete Your Account?');
    if(data == true) {
        alert("We are sorry, There is no way to delete your account");
        toastr.info("We are sorry, There is no way to delete your account");
    }
}


function uniqueEmailProfile() {
    let product = {};

    product.email = emailModal.value;
    product.unique_id_me = unique_id_me.innerText;

    axios.post("../api/about_update/unique_email.php",
    product, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        if (res.data == "0") {
            toastr.error("This email is used by someone. You can not use this email");
            alert("This email is used by someone. You can not use this email");
            emailModal.value = myMail;
        }
    })
    .catch(err => {
        console.log(err);
    })
}


function uniqueEmailRegister() {
    let product = {};

    product.email = email.value;

    axios.post("../api/reg_uniq_email.php",
    product, {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(res => {
        if (res.data == "0") {
            toastr.error("This email is used by someone. You can not use this email");
            alert("This email is used by someone. You can not use this email");
            email.value = "";
        }
    })
    .catch(err => {
        console.log(err);
    })
}