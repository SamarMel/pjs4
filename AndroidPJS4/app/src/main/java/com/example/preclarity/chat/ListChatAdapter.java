package com.example.preclarity.chat;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;

import com.example.preclarity.ImageLoad;
import com.example.preclarity.R;

import java.util.List;

public class ListChatAdapter extends ArrayAdapter<Utilisateur> {

    public ListChatAdapter(@NonNull Context context, @NonNull List<Utilisateur> objects) {
        super(context, 0 , objects);
    }

    private static class ContactHolder{
        TextView pseudo;
        ImageView picture;
    }

    public View getView(int position, View convertView, ViewGroup parent){
        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.row_conversation,parent, false);
        }

        ContactHolder viewHolder = (ContactHolder) convertView.getTag();
        if(viewHolder == null){
            viewHolder = new ContactHolder();
            viewHolder.pseudo = (TextView) convertView.findViewById(R.id.pseudoContact);
            viewHolder.picture = (ImageView) convertView.findViewById(R.id.convPhoto);

        }

        Utilisateur u = getItem(position);
        viewHolder.pseudo.setText(u.getPseudo());
        viewHolder.picture.setImageBitmap(ImageLoad.getBitmapFromURL(u.getPicture()));
        return convertView;

    }
}
