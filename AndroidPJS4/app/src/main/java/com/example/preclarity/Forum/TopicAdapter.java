package com.example.preclarity.Forum;

import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;

import com.example.preclarity.Forum.Topic;
import com.example.preclarity.R;
import com.example.preclarity.TopicActivity;

import java.util.List;

public class TopicAdapter extends ArrayAdapter<Topic> implements View.OnClickListener {

    public TopicAdapter(@NonNull Context context,  @NonNull List<Topic> objects) {
        super(context, 0, objects);

    }

    @Override
    public void onClick(View v) {
        //PASSER EN PARAMTRE DE L'INTENT L'ID DU TOPIC
        Log.w("UN TOPIC SELECTIONNE","yeah");
        int position=(Integer) v.getTag();
        Object object= getItem(position);
        Topic topic=(Topic)object;
        int id = topic.getId();
        Intent intent = new Intent(getContext(), TopicActivity.class);
        intent.putExtra("idTopic", id);
        getContext().startActivity(intent);
    }

    private static class ForumViewHolder {
         TextView sujet;
        TextView auteur;
         TextView date;
    }

    public View getView(int position, View convertView, ViewGroup parent){
        if(convertView == null){
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.row,parent, false);
        }
        ForumViewHolder viewHolder = (ForumViewHolder) convertView.getTag();
        if(viewHolder == null){
            viewHolder = new ForumViewHolder();
            viewHolder.auteur = (TextView) convertView.findViewById(R.id.auteur);
            viewHolder.sujet = (TextView) convertView.findViewById(R.id.sujet);
            viewHolder.date = (TextView) convertView.findViewById(R.id.date);
            convertView.setTag(viewHolder);
        }

        //getItem(position) va récupérer l'item [position] de la List<Tweet> tweets
        Topic topic = getItem(position);
        viewHolder.sujet.setText(topic.getSujet());
        viewHolder.auteur.setText(topic.getAuteur());
        viewHolder.date.setText(topic.getDate());
        return convertView;

    }
}
