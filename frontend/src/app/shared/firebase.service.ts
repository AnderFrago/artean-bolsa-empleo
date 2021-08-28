import { Injectable } from '@angular/core';

import { AngularFirestore } from '@angular/fire/firestore';

@Injectable({
  providedIn: 'root',
})
export class FirebaseService {
  private role: string;
  private username: string;
  constructor(private firestore: AngularFirestore) {}

  create_User(record) {
    return this.firestore.collection('Users').add(record);
  }
  read_Users() {
    return this.firestore.collection('Users').snapshotChanges();
    // return this.firestore.collection('Users').snapshotChanges();
    // return this.firestore
    //   .collection('/Users', (ref) => ref.where('id', '==', userId))
    //   .snapshotChanges();
  }
  read_Username() {
    this.username = '';
    let userId = localStorage.getItem('artean_id');
    return this.firestore
      .collection('Users')
      .snapshotChanges()
      .subscribe((collection) => {
        collection.map((data) => {
          if (data.payload.doc.id == userId) {
            this.username = data.payload.doc.data()['username'];
          }
        });
      });
  }
  get_Username() {
    if (this.username == null) this.read_Username();
    return this.username;
  }

  clear_Username() {
    // this.read_Username();
    this.username = '';
  }
  read_Role(userId?) {
    if (userId == null) userId = localStorage.getItem('artean_id');

    this.firestore
      .collection('Users')
      .snapshotChanges()
      .subscribe((collection) => {
        collection.map((data) => {
          if (data.payload.doc.id == userId) {
            this.role = data.payload.doc.data()['role'];
          }
        });
      });
  }
  clear_Role() {
    this.role = '';
  }
  check_RoleStudent() {
    return this.role === 'ROLE_STUDENT';
  }
  check_RoleEmployer() {
    return this.role === 'ROLE_EMPLOYER';
  }
  check_RoleArtean() {
    return this.role === 'ROLE_ARTEAN';
  }

  update_User(recordID, record) {
    this.firestore.doc('Users/' + recordID).update(record);
  }
  delete_User(record_id) {
    this.firestore.doc('Users/' + record_id).delete();
  }
}
