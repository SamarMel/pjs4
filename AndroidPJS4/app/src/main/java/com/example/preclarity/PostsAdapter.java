package com.example.preclarity;

import android.content.Context;
import android.graphics.Bitmap;
import android.media.Image;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;

import com.example.preclarity.Forum.TopicAdapter;

import java.util.List;

public class PostsAdapter extends ArrayAdapter<Post> {

    public PostsAdapter(@NonNull Context context,  @NonNull List<Post> objects) {
        super(context, 0, objects);
    }

    private static class PostViewHolder{
        TextView pseudo;
        TextView date;
        TextView content;
        ImageView picture;
    }

    public View getView(int position, View convertView, ViewGroup parent){
        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.row_post,parent, false);
        }

        PostViewHolder viewHolder = (PostViewHolder) convertView.getTag();
        if(viewHolder == null){
            viewHolder = new PostViewHolder();
            viewHolder.pseudo = (TextView) convertView.findViewById(R.id.pseudoPost);
            viewHolder.content= (TextView) convertView.findViewById(R.id.post);
            viewHolder.date = (TextView) convertView.findViewById(R.id.datePost);
            viewHolder.picture = (ImageView) convertView.findViewById(R.id.user_profile);
            convertView.setTag(viewHolder);
        }
        Post post = getItem(position);
        viewHolder.pseudo.setText(post.getPseudo());
        viewHolder.content.setText(post.getContent());
        viewHolder.date.setText(post.getDate());
        viewHolder.picture.setImageDrawable(getContext().getResources().getDrawable(R.drawable.twitter_oeuf));
       // viewHolder.picture.setImageBitmap(ImageLoad.getBitmapFromURL(post.getPicture()));
        return convertView;
    }
}
